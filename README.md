# 🦸‍♂️ Proyecto de Superhéroes

## ¿Qué es esto?

Es una página web que hice con **CodeIgniter 4** donde puedes:
- Crear reportes de superhéroes en PDF
- Ver gráficos con datos de superhéroes
- Filtrar información como quieras

## ¿Qué hace?

### 📊 Hacer PDFs
- Crear reportes de superhéroes
- Descargar los PDFs
- Filtrar por género y cantidad

### 📈 Ver Gráficos
- Gráfico de barras de editoras
- Gráfico de líneas de pesos
- Seleccionar qué ver
- Cambiar el orden

## ¿Qué usa?

- **PHP** con CodeIgniter 4
- **HTML, CSS, JavaScript**
- **MySQL** (base de datos)
- **Bootstrap** (para que se vea bonito)
- **Chart.js** (para los gráficos)

## ¿Cómo está organizado?

```
superhero/
├── app/
│   ├── Controllers/     # Controladores
│   ├── Models/          # Modelos
│   ├── Views/           # Páginas HTML
│   └── Database/        # Base de datos
└── public/              # Archivos públicos
```

## Base de Datos

### Tablas:
- **superhero:** Datos de superhéroes
- **publisher:** Editoras (Marvel, DC, etc.)
- **gender:** Géneros
- **race:** Razas
- **alignment:** Héroe o villano

### Vistas que hice:
1. **view_superhero_gender_report** - Para PDFs
2. **view_weight_by_publisher** - Para gráfico de pesos
3. **view_publishers_comparison** - Para gráfico de editoras

## ¿Qué puedes hacer?

### 1. Hacer PDFs
**Ir a:** `/reportes/gender-limit-ui`
- Llenar un formulario
- Elegir género
- Poner cuántos quieres (10-200)
- Descargar el PDF

### 2. Ver Gráfico de Editoras
**Ir a:** `/dashboard/informe5`
- Ver gráfico de barras
- Seleccionar editoras
- Filtrar el gráfico
- Limpiar selección

### 3. Ver Gráfico de Pesos
**Ir a:** `/dashboard/informe6`
- Ver gráfico de líneas
- Cambiar orden
- Ver todas las editoras

## ¿Cómo instalarlo?

### Necesitas:
- PHP 8.0 o más
- MySQL
- XAMPP
- Composer

### Pasos:

1. **Descargar el proyecto**
2. **Instalar:**
   ```bash
   composer install
   ```

3. **Base de datos:**
   - Crear base de datos `superhero`
   - Importar archivos SQL

4. **Abrir:**
   ```
   http://superhero.test
   ```

## ¿Cómo usarlo?

### Para hacer PDFs:
1. Ir a `http://superhero.test/reportes/gender-limit-ui`
2. Elegir género
3. Poner cantidad (10-200)
4. Hacer clic en "Generar Reporte"
5. Se descarga el PDF

### Para ver gráficos:
1. **Editoras:** `http://superhero.test/dashboard/informe5`
   - Seleccionar editoras
   - Hacer clic en "Actualizar Gráfico"
   - Usar "Limpiar" para quitar selección

2. **Pesos:** `http://superhero.test/dashboard/informe6`
   - Ver todas las editoras
   - Cambiar orden
   - Ver tendencia

## ¿Cómo se ve?

- **Bootstrap** para que se vea bonito
- **Iconos** para facilitar uso
- **Validaciones** para evitar errores
- **Mensajes claros** si algo sale mal

## Rutas principales

- `http://superhero.test/reportes/gender-limit-ui` - Hacer PDFs
- `http://superhero.test/dashboard/informe5` - Gráfico de editoras
- `http://superhero.test/dashboard/informe6` - Gráfico de pesos
