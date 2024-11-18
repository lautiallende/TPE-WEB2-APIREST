# TPE WEB 2 - API REST

Este proyecto es una implementación completa de una **API REST** desarrollada para la materia **Programación Web II**, cumpliendo con todas las pautas y requisitos indicados en el trabajo práctico. A continuación, se detallan las características principales y funcionalidades incluidas.

---

## 📋 Funcionalidades implementadas

### **1. CRUD completo para Instrumentos**
- **Create**: Permite agregar nuevos instrumentos a la base de datos.
- **Read**: Recupera todos los instrumentos, con soporte para filtros, ordenamiento y paginación.
- **Update**: Modifica los detalles de un instrumento existente.
- **Delete**: Elimina un instrumento según su ID.

### **2. CRUD completo para Marcas**
- **Create**: Se pueden agregar nuevas marcas con nombre y dirección.
- **Read**: Listado de todas las marcas disponibles, además de la obtención de una marca específica por ID.
- **Update**: Se permite editar el nombre y dirección de una marca.
- **Delete**: Eliminación de una marca específica de la base de datos.

### **3. Rutas RESTful**
Se configuraron rutas RESTful para cada entidad, organizadas de manera coherente:
- `/api/instrumentos`
- `/api/instrumentos/:id`
- `/api/marcas`
- `/api/marcas/:id`

### **4. Filtros y ordenamiento dinámico**
- Filtrado por propiedades específicas (por ejemplo, país, categoría, etc.).
- Ordenamiento dinámico por diferentes campos, con soporte para direcciones ascendentes y descendentes.

### **5. Autenticación y autorización**
- Implementación de autenticación básica para realizar operaciones sensibles como **crear**, **editar** o **eliminar** recursos.

### **6. Manejo de errores**
- Respuestas claras y consistentes en formato JSON para errores comunes como:
  - Recursos no encontrados (`404`).
  - Operaciones no autorizadas (`401`).
  - Campos faltantes o datos inválidos (`400`).

### **7. Código modular y estructurado**
- Implementación basada en el patrón **MVC (Modelo-Vista-Controlador)**.
- Separación clara de responsabilidades:
  - **Modelos**: Gestión de la base de datos.
  - **Controladores**: Lógica de negocio.
  - **Vistas**: Respuestas en formato JSON.

### **8. Uso de herramientas modernas**
- **PHP**: Lenguaje principal.
- **MySQL**: Base de datos relacional.
- **Thunder Client**: Pruebas de endpoints.
- **Git**: Control de versiones.

### AUTORES: Valentin Aspiroz (valentin102005@gmail.com) y Lautaro Allende (lautaroallende13@gmail.com).
