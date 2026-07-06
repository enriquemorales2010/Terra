# Terra

Proyecto PHP para publicar en GitHub y en un hosting web.

## Pasos para GitHub

1. Crear un repositorio nuevo en GitHub.
2. Desde esta carpeta ejecutar:

```bash
git init
git branch -M main
git add .
git commit -m "Primer commit"
git remote add origin https://github.com/USUARIO/REPO.git
git push -u origin main
```

## Pasos para el hosting

1. Subir el contenido de la carpeta [Terra2026](Terra2026) al directorio público del hosting (por ejemplo, public_html).
2. Copiar [Terra2026/clases/conexion.php.example](Terra2026/clases/conexion.php.example) como [Terra2026/clases/conexion.php](Terra2026/clases/conexion.php) y ajustar los datos reales de la base de datos.
3. Verificar permisos de escritura en carpetas que el sistema necesite.
4. Asegurarse de que la base de datos exista y esté accesible desde el hosting.
