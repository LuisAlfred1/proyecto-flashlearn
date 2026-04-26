# 📁 Proyecto FlashLearn

Proyecto desarrollado con **Laravel**. Lee este README completo antes de empezar a trabajar.

---

## 📋 Tabla de contenido

- [Estructura de ramas](#-estructura-de-ramas)
- [Configuración inicial](#-configuración-inicial-solo-la-primera-vez)
- [Flujo de trabajo diario](#-flujo-de-trabajo-diario)
- [Convención de commits](#-convención-de-commits)
- [Reglas importantes](#-reglas-importantes)
- [Solución de errores comunes](#-solución-de-errores-comunes)

---

## 🌿 Estructura de ramas

```
main        ← Producción. NUNCA tocar directamente.
develop     ← Rama de integración. Aquí llegan todos los Pull Requests.
luis        ← Rama personal de Luis
angel       ← Rama personal de angel
harleth     ← Rama personal de harleth
```

> ⚠️ **Cada quien trabaja SIEMPRE en su propia rama.**
> ⚠️ **Solo el coordinador (Luis) hace merge a `main`.**

---

## ⚙️ Configuración inicial (solo la primera vez)

```bash
# 1. Clonar el repositorio
git clone https://github.com/LuisAlfredo1/proyecto-flashlearn.git
cd proyecto-flashlearn

# 2. Instalar dependencias de PHP
composer install

# 3. Instalar dependencias de Node
npm install

# 4. Crear tu archivo de entorno
cp .env.example .env

# 5. Generar la clave de la aplicación
php artisan key:generate

# 6. Configurar tu base de datos en el archivo .env
#    Edita estas líneas con tus datos locales:
#    DB_DATABASE=nombre_tu_bd
#    DB_USERNAME=tu_usuario
#    DB_PASSWORD=tu_contraseña

# 7. Correr las migraciones
php artisan migrate
```

---

## 🔄 Flujo de trabajo diario

Sigue estos pasos **cada vez** que vayas a trabajar en algo nuevo.

### Paso 1 — Cambia a tu rama personal y actualízala

```bash
git checkout tu-nombre
git pull origin tu-nombre
```

> Ejemplo si eres angel:
> ```bash
> git checkout angel
> git pull origin angel
> ```

### Paso 2 — Sincroniza con develop por si hay cambios nuevos

```bash
git fetch origin
git merge origin/develop
```

> Esto trae los últimos cambios de develop desde GitHub y los integra en tu rama.

### Paso 3 — Trabaja y haz commits frecuentes

```bash
# Ver qué archivos cambiaste
git status

# Agregar tus cambios
git add .

# Hacer commit con un mensaje descriptivo
git commit -m "feat: descripción de lo que hiciste"
```

### Paso 4 — Sube tus cambios a GitHub

```bash
git push origin tu-nombre
```

### Paso 5 — Abre un Pull Request hacia develop

1. Ve al repositorio en GitHub
2. Haz clic en **"Compare & pull request"**
3. ⚠️ Verifica que el destino sea **`develop`** (nunca `main`)
4. Escribe una descripción clara de lo que hiciste
5. Haz clic en **"Create pull request"**

```
tu-nombre ──────────→ develop ──────────→ main
           (tú abres PR)      (Luis hace merge)
```

> ✅ Luis revisará, aprobará y hará el merge a `develop`.
> ✅ Cuando haya suficientes cambios listos, Luis pasa `develop` a `main`.

---

## 💬 Convención de commits

Usa este formato en todos tus commits:

```
tipo: descripción corta en minúsculas
```

| Tipo | Cuándo usarlo |
|------|---------------|
| `feat` | Nueva funcionalidad |
| `fix` | Corrección de un bug |
| `refactor` | Mejorar código sin cambiar funcionalidad |
| `docs` | Cambios en documentación |
| `style` | Formato, espacios (sin lógica) |
| `chore` | Tareas de mantenimiento, dependencias |

**Ejemplos:**
```bash
git commit -m "feat: crear modelo y migración de productos"
git commit -m "fix: corregir validación en formulario de contacto"
git commit -m "docs: actualizar instrucciones del README"
```

---

## 🚫 Reglas importantes

- ❌ **Nunca** hacer push directo a `main` o `develop`
- ❌ **Nunca** trabajar en la rama de otro compañero
- ❌ **Nunca** subir el archivo `.env` (ya está en `.gitignore`)
- ✅ **Siempre** trabajar en tu rama personal
- ✅ **Siempre** sincronizar con `develop` antes de ponerte a trabajar
- ✅ **Siempre** el PR va hacia `develop`, nunca a `main`

---

## 🛠️ Solución de errores comunes

### ❗ "Your local changes would be overwritten by merge"

Tienes archivos locales sin commitear que entran en conflicto con el pull.

```bash
# Opción A: Guardar tus cambios temporalmente
git stash
git pull origin develop
git stash pop

# Opción B: Si no necesitas esos cambios locales
git checkout -- nombre-del-archivo
git pull origin develop
```

---

### ❗ "Please tell me who you are" (primera vez con git)

```bash
git config --global user.email "tu@email.com"
git config --global user.name "Tu Nombre"
```

---

### ❗ Tengo conflictos al hacer merge con develop

```bash
# Git te marcará los archivos con conflicto
# Ábrelos en tu editor, busca estas marcas y resuelve:

tu código

# Una vez resuelto:
git add .
git commit -m "merge: resolver conflictos con develop"
```

---

## 👥 Equipo

| Nombre | Rol | Rama |
|--------|-----|------|
| Luis Reyes     | Desarrollador | `luis` |
| Ángel Flores   | Desarrollador | `angel` |
| Harleth García | Desarrollador | `harleth` |
