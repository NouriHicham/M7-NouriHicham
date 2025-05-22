# Documentació de la API

## Explicació de JWT

El JWT s'utilitza per autenticar els usuaris, quan un usuari inicia sessió amb les seves credencials, el servidor retorna un token. Aquest token serveix per a futures peticions posteriors poder accedir a rutes protegides
El token JWT conté informació codificada sobre l'usuari i té una validesa limitada. Quan el token expira, l'usuari ha de tornar a iniciar sessió. El servidor valida el token en cada petició per garantir la seguretat.

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

-   **GET /api/users/{id}/pets**  
    Llista les mascotes d'un usuari concret.

### Gestió de mascotes (requereix autenticació)

-   **GET /api/pets**  
    Llista totes les mascotes de l'usuari autenticat.

-   **POST /api/pets**  
    Crea una nova mascota per a l'usuari autenticat.

-   **PUT /api/pets/{id}**  
    Actualitza totes les dades d'una mascota.

-   **PATCH /api/pets/{id}**  
    Actualitza parcialment les dades d'una mascota.

-   **DELETE /api/pets/{id}**  
    Elimina una mascota.

## Exemple de credencials de prova

Usuari admin per fer proves:

-   **Email:** admin@admin.com
-   **Password:** 12345678
