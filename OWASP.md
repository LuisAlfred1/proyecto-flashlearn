# 🛡️ OWASP TOP 10 — FlashLearn

Estándares de seguridad aplicados al proyecto. Se implementaron **3 controles** del estándar OWASP TOP 10, seleccionados según los riesgos más relevantes para esta aplicación.

---

## A03 — Injection

### ¿Por qué aplica?
El usuario escribe el tema de estudio libremente en un formulario. Sin validación, alguien podría intentar inyectar contenido malicioso que manipule el prompt enviado a la IA (*prompt injection*) o afecte la base de datos.

### ¿Qué se implementó?
- Validación estricta con `$request->validate()` en el controlador
- Longitud máxima del campo tema limitada a 100 caracteres
- El campo idioma solo acepta valores de una lista cerrada (`in:`)
- Sanitización del input antes de armar el prompt

### Código aplicado

```php
$request->validate([
    'tema'     => 'required|string|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]+$/',
    'language' => 'required|string|in:Inglés,Francés,Alemán,Italiano,Portugués,Japonés,Chino',
]);
```

---

## A05 — Security Misconfiguration

### ¿Por qué aplica?
La aplicación utilizará una API key de Gemini para conectarse a la IA. Si esa clave queda expuesta en el código fuente o en el repositorio de GitHub, cualquier persona podría usarla, generando costos elevados o abusando del servicio.

### ¿Qué se implementó?
- La API key se almacena exclusivamente en el archivo `.env`
- El archivo `.env` está incluido en `.gitignore` por defecto en Laravel
- En producción se verifica que `APP_DEBUG=false` para no exponer stack traces con información sensible

### Código aplicado

```php
// ✅ Correcto — la clave se lee desde el entorno
$apiKey = env('GEMINI_API_KEY');

// ❌ Nunca hardcodear la clave directamente
$apiKey = 'sk-ant-xxxxxxxxxxxxxx';
```

```env
# .env
APP_DEBUG=false
GEMINI_API_KEY=sk-gem-xxxxxxxxxxxxxx
```

> [!NOTE]
> El archivo `.env` nunca se sube a Git. El valor real de `GEMINI_API_KEY`
> se comparte entre el equipo por un canal privado (WhatsApp, Discord, etc.).
> En `.env.example` solo se deja el nombre de la variable sin valor.

---

## A07 — Identification and Authentication Failures (Rate Limiting)

### ¿Por qué aplica?
El endpoint `/generate` realiza una llamada a la IA en cada petición. Sin un límite de solicitudes, cualquier persona podría automatizar cientos de peticiones, abusando de la API key del proyecto y generando costos elevados.

### ¿Qué se implementó?
Rate limiting integrado de Laravel, limitando a **5 peticiones por minuto por IP** sobre el endpoint de generación.

### Código aplicado

**`App\Providers\AppServiceProvider.php`**
```php
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

public function boot(): void
{
    RateLimiter::for('generate', function (Request $request) {
        return Limit::perMinute(5)->by($request->ip());
    });
}
```

**`routes/web.php`**
```php
Route::post('/generate', [FlashcardController::class, 'generate'])
     ->middleware('throttle:generate')
     ->name('flashcards.generate');
```

> Cuando se supera el límite, Laravel responde automáticamente con un error `429 Too Many Requests`.

---

## Resumen

| Control | OWASP | Riesgo mitigado | Archivo |
|---|---|---|---|
| Validación de inputs | A03 Injection | Prompt injection / SQL injection | `FlashcardController.php` |
| Variables de entorno | A05 Security Misconfiguration | Exposición de API key | `.env` / `.gitignore` |
| Rate Limiting | A07 Auth Failures | Abuso del endpoint de IA | `AppServiceProvider.php` / `web.php` |