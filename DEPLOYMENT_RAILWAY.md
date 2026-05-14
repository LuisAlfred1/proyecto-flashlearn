# 🚀 Guía de Despliegue en Railway

Este documento proporciona instrucciones paso a paso para desplegar **FlashLearn** en [Railway](https://railway.app).

---

## 📋 Requisitos Previos

Antes de empezar, necesitas:

- Una cuenta en [Railway](https://railway.app)
- Una cuenta en [Google Cloud Console](https://console.cloud.google.com) para OAuth
- Una API key de [Google Gemini](https://makersuite.google.com/app/apikey)
- Este repositorio clonado localmente
- Git instalado

---

## 🔑 Variables de Entorno Requeridas

Estas son todas las variables que necesitarás configurar en Railway:

### Variables Básicas de Laravel

```env
APP_NAME=FlashLearn
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio-en-railway.railway.app

APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=es_ES

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_LEVEL=warning
```

### Base de Datos PostgreSQL

```env
DB_CONNECTION=pgsql
DB_HOST=${DATABASE_INTERNAL_HOST}
DB_PORT=5432
DB_DATABASE=${DATABASE_NAME}
DB_USERNAME=${DATABASE_USER}
DB_PASSWORD=${DATABASE_PASSWORD}
```

*(Railway proporciona estas variables automáticamente)*

### Sesiones y Cache

```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

CACHE_STORE=database
QUEUE_CONNECTION=database
BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
```

### APIs Externas

#### Google OAuth
```env
GOOGLE_CLIENT_ID=tu-google-client-id-aqui.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=tu-google-client-secret-aqui
GOOGLE_REDIRECT_URI=https://tu-dominio-en-railway.railway.app/auth/google/callback
```

**Cómo obtenerlo:**
1. Ve a [Google Cloud Console](https://console.cloud.google.com)
2. Crea un nuevo proyecto
3. Habilita Google+ API
4. Crea credenciales OAuth 2.0 (tipo: Aplicación web)
5. Autorizado URIs de redireccionamiento: `https://tu-dominio.railway.app/auth/google/callback`
6. Copia el Client ID y Client Secret

#### Google Gemini API
```env
GEMINI_API_KEY=tu-gemini-api-key-aqui
```

**Cómo obtenerlo:**
1. Ve a [Google AI Studio](https://makersuite.google.com/app/apikey)
2. Crea una nueva API key
3. Cópiala en Railway

### Email (Opcional)

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@flashlearn.app
MAIL_FROM_NAME=FlashLearn
```

---

## 📦 Pasos para Desplegar en Railway

### Paso 1: Crear Proyecto en Railway

1. Inicia sesión en [Railway](https://railway.app)
2. Click en **"New Project"** (o el botón +)
3. Selecciona **"Deploy from GitHub"**
4. Autoriza Railway a acceder a tu GitHub
5. Busca y selecciona el repositorio `proyecto-flashlearn`
6. Selecciona la rama **`main`** para producción

### Paso 2: Agregar Base de Datos PostgreSQL

1. En tu proyecto Railway, click en **"Add Service"** o **"+"**
2. Busca **PostgreSQL** y selecciona
3. Railway creará automáticamente una instancia PostgreSQL
4. Las variables `DATABASE_*` se agregarán automáticamente al proyecto

### Paso 3: Configurar Variables de Entorno

1. Ve a la pestaña **"Variables"** del servicio Laravel
2. Copia todas las variables de la sección [Variables de Entorno Requeridas](#-variables-de-entorno-requeridas)
3. Completa con tus valores reales:
   - `APP_KEY`: Ejecuta localmente `php artisan key:generate --show` y copia el valor
   - `GOOGLE_CLIENT_ID` y `GOOGLE_CLIENT_SECRET`: De Google Cloud
   - `GEMINI_API_KEY`: De Google AI Studio
   - `GOOGLE_REDIRECT_URI`: Tu URL en Railway

**Obtener el APP_KEY:**
```bash
# Localmente
php artisan key:generate --show
```

Copia la salida (ejemplo: `base64:...`) y pégalo en `APP_KEY` en Railway.

### Paso 4: Configurar el Procfile (Opcional pero Recomendado)

Railway debería detectar automáticamente que es una aplicación Laravel, pero puedes asegurar el despliegue correctamente creando un `Procfile`:

```procfile
web: vendor/bin/heroku-php-apache2 public/
```

Este archivo ya debería estar en el proyecto, pero verifica que exista.

### Paso 5: Compilar Assets (Vite)

Railway ejecutará automáticamente los siguientes comandos:

```bash
composer install --optimize-autoloader --no-dev
npm ci
npm run build
```

Si esto no ocurre automáticamente, agrega un `start` script en `package.json`:

```json
"scripts": {
  "build": "vite build",
  "dev": "vite",
  "start": "npm run build"
}
```

### Paso 6: Ejecutar Migraciones

Una vez que la app se despliega por primera vez, ejecuta las migraciones:

1. Ve a tu proyecto en Railway
2. Abre la consola terminal de tu servicio Laravel
3. Ejecuta:

```bash
php artisan migrate --force
```

*(La bandera `--force` es necesaria en producción)*

---

## 🔧 Comandos Útiles en Railway

Una vez desplegado, puedes ejecutar comandos directamente en la consola de Railway:

### Migraciones
```bash
# Ejecutar migraciones pendientes
php artisan migrate --force

# Revertir última migración
php artisan migrate:rollback --force

# Ver estado de migraciones
php artisan migrate:status
```

### Seeders (Datos de Prueba)
```bash
# Ejecutar seeders
php artisan db:seed --force

# Específico seeder
php artisan db:seed --class=SpecificSeeder --force
```

### Cache
```bash
# Limpiar todo el cache
php artisan cache:clear

# Limpiar config cache
php artisan config:clear

# Reconstruir config cache
php artisan config:cache
```

### Logs
```bash
# Ver logs en tiempo real
tail -f storage/logs/laravel.log
```

---

## ✅ Checklist de Despliegue

- [ ] Repositorio conectado a Railway
- [ ] PostgreSQL agregado como servicio
- [ ] `APP_KEY` configurado correctamente
- [ ] `GOOGLE_CLIENT_ID` y `GOOGLE_CLIENT_SECRET` configurados
- [ ] `GOOGLE_REDIRECT_URI` apunta a tu dominio en Railway
- [ ] `GEMINI_API_KEY` configurado
- [ ] `APP_URL` configurado con tu dominio de Railway
- [ ] Migraciones ejecutadas (`php artisan migrate --force`)
- [ ] Assets compilados (`npm run build` ejecutado)
- [ ] App accesible en `https://tu-dominio.railway.app`
- [ ] Login con Google funciona
- [ ] Generación de flashcards con Gemini funciona
- [ ] Guardado de flashcards a base de datos funciona

---

## 🐛 Solución de Problemas

### Error: "No application encryption key has been defined"

**Causa:** `APP_KEY` no está configurado.

**Solución:**
1. Ejecuta localmente: `php artisan key:generate --show`
2. Copia el valor (comienza con `base64:`)
3. Agrega en Railway como variable `APP_KEY`
4. Redeploy el proyecto

### Error: "SQLSTATE[HY000]: General error"

**Causa:** Las migraciones no se ejecutaron.

**Solución:**
1. Abre la consola de Railway
2. Ejecuta: `php artisan migrate --force`

### Google OAuth no funciona

**Causa:** `GOOGLE_REDIRECT_URI` no coincide con la configuración en Google Cloud.

**Solución:**
1. Ve a [Google Cloud Console](https://console.cloud.google.com)
2. Edita la credencial OAuth
3. Asegúrate que "Authorized redirect URIs" incluya exactamente: `https://tu-dominio-railway.railway.app/auth/google/callback`
4. Guarda y redeploy en Railway

### Error 500 al generar flashcards

**Causa:** `GEMINI_API_KEY` no está configurado o es inválido.

**Solución:**
1. Verifica que `GEMINI_API_KEY` esté en Railway
2. Ve a [Google AI Studio](https://makersuite.google.com/app/apikey)
3. Genera una nueva API key si la anterior está inactiva
4. Actualiza en Railway y redeploy

### Assets (CSS/JS) no cargan

**Causa:** Vite no se compiló correctamente.

**Solución:**
1. En la consola de Railway: `npm run build`
2. Verifica que el directorio `public/build` exista
3. Limpia el cache: `php artisan view:clear`

---

## 📊 Monitoreo en Production

### Ver Logs en Tiempo Real

En la pestaña **"Logs"** de tu servicio en Railway, puedes ver:
- Requests HTTP
- Errores de la aplicación
- Queries a la base de datos

### Métricas

Railway proporciona:
- CPU y memoria usados
- Número de deployments
- Uptime

### Variables de Debug

Para debugging avanzado en production (úsalo solo temporalmente):

```env
APP_DEBUG=true
LOG_LEVEL=debug
```

**⚠️ Recuerda cambiarlos a `false` y `warning` cuando termines**

---

## 🔄 Actualizar la App en Production

Cada vez que hagas push a `main`:

1. Railway detectará automáticamente los cambios
2. Ejecutará: `composer install`, `npm install`, `npm run build`
3. Reiniciará la app

**Para ejecutar migraciones después de un push:**
1. Abre la consola en Railway
2. Ejecuta: `php artisan migrate --force`

---

## 🎯 URL Producción

Tu aplicación estará disponible en:

```
https://tu-nombre-proyecto.railway.app
```

Railway te asignará automáticamente este dominio. Puedes verlo en:
- Pestaña **"Settings"** → **"Domains"**
- O en el dashboard principal del proyecto

---

## 💡 Tips de Production

1. **Siempre usa `--force`** en migraciones en producción
2. **Mantén logs activos** para debugging
3. **Configura alertas** en Railway para downtime
4. **Haz backups regulares** de la base de datos PostgreSQL
5. **Revisa logs regularmente** para errores
6. **Usa `.env.example`** como referencia en Git, NUNCA subas `.env`

---

## 📚 Referencias Útiles

- [Documentación de Railway](https://docs.railway.app)
- [Documentación de Laravel](https://laravel.com/docs)
- [Google Cloud Console](https://console.cloud.google.com)
- [Google Gemini API](https://ai.google.dev)

---

## ❓ Preguntas Frecuentes

**¿Railway tiene un plan gratuito?**
Sí, con $5 USD de crédito mensual. Suficiente para una app pequeña con PostgreSQL.

**¿Puedo usar SQLite en production?**
No se recomienda. SQLite es para desarrollo. Usa PostgreSQL en production.

**¿Cómo agrego un dominio personalizado?**
En Railway → Proyecto → Settings → Domains → "Add Custom Domain"

**¿Cómo backup la base de datos?**
Railway realiza backups automáticos. Ve a Settings → Backups en tu servicio PostgreSQL.

---

**Última actualización:** Mayo 2026
**Versión:** 1.0
