# 🛍️ **Trabajo Práctico: Tienda de Ropa**

## **👥 Participantes**:

- **Alumno 1:** Ariadna Avila
- **Alumno 2:** Juan Marcos Lorenzo

---

> ⚠️ **Descripción del Trabajo**  
> Este trabajo práctico consiste en el diseño y desarrollo de una web para una tienda de ropa. Los usuarios podrán interactuar con las distintas prendas disponibles, gestionando el stock, seleccionando talles y añadiendo productos al carrito.  
> La base de datos está diseñada para gestionar productos y su información asociada, permitiendo a la tienda administrar eficientemente su catálogo.

---

## 📊 **Estructura de la Base de Datos**

La base de datos está compuesta por dos tablas principales:

### **1. productos**:

> ℹ️ **Descripción**:  
> Esta tabla almacena la información principal de cada producto disponible en la tienda, como su nombre, código, precio y cantidad en stock.

> **Campos principales**:
>
> - `id_producto` (clave primaria)
> - `tipo`
> - `precio`
> - `id_categoria` (clave foránea)

### **2. categorias**:

> ℹ️ **Descripción**:  
> Contiene información sobre las categorías, como el nombre de la categoría, el id de cada categoría, y una columna para imágenes.

> **Campos principales**:
>
> - `id_categoria` (clave primaria)
> - `nombre_categoria`
> - `imagen_categoria`

---

## 🔗 **Relación entre las Tablas**

> 🔄 **Uno a Muchos**:  
> La relación entre la tabla `productos` y `categorias` es de uno a N (_uno a muchos_), donde cada producto en la tabla `productos` tiene una entrada correspondiente en `categorias` que contiene información más detallada.

---

## 🎯 **Objetivo**

> 💡 **Descripción**:  
> El objetivo de este trabajo es demostrar el uso de bases de datos relacionales para gestionar información de productos en el contexto de una tienda de ropa, asegurando que la estructura esté normalizada y facilite consultas eficientes.

---

![Diagrama de la relación entre tablas](images/relacion.png)
