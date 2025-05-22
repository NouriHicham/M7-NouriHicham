# Documentació de la API

## Llistat de rutes

### Autenticació

-   **POST /api/register**  
    Registra un nou usuari.  
    Paràmetres: `name`, `email`, `password`, `password_confirmation`, `role` (`admin` o `user`)

-   **POST /api/login**  
    Inicia sessió i retorna un token JWT.  
    Paràmetres: `email`, `password`

-   **POST /api/logout**  
    Tanca la sessió (requereix token JWT).

-   **GET /api/user**  
    Retorna l'usuari autenticat (requereix token JWT).

### Gestió d'usuaris (només admin)

-   **GET /api/users**  
    Llista tots els usuaris.

-   **GET /api/users/{id}**  
    Mostra un usuari concret.

-   **PUT /api/users/{id}**  
    Actualitza un usuari.

-   **DELETE /api/users/{id}**  
    Elimina un usuari.

## Exemple de credencials de prova

Usuari admin per fer proves:

-   **Email:** admin@admin.com
-   **Password:** 12345678

-   **Email:** user@user.com
-   **Password:** 12345678
