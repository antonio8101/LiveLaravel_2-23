# Live Laravel 
## Backend Web Developer - Modulo 3 Laravel - Edizione 2/23

Benvenuti nel progetto dimostrativo di questo corso su **Laravel**! 🎉

Questo repository è stato creato per supportare le lezioni e per fornire agli studenti un ambiente pratico dove poter
rivedere quanto presentato durante il corso.

## Obiettivi del Progetto

- Approfondire concetti fondamentali di **Laravel** visti nella parte teorica.
- Messa in pratica di nozioni teoriche tramite implementazioni reali e guidate.
- Supportare la presentazione degli argomenti trattati durante il corso.
- Creare una base di studio per ulteriori sviluppi e approfondimenti sperimentali post-corso

## Struttura del Progetto

Il progetto è strutturato seguendo le migliori pratiche di Laravel e coprirà i seguenti aspetti:

- **Routing**: Creazione e gestione delle rotte.
- **Controller e Middleware**: Logica del controller e gestione delle richieste.
- **Blade Templates**: Utilizzo del motore di templating di Laravel per creare interfacce utente.
- **Eloquent ORM**: Gestione di database e modelli.
- **Autenticazione**: Introduzione al sistema di autenticazione nativo di Laravel.
- **API REST**: Creazione di endpoint per comunicazioni API.

## Prerequisiti

Per lavorare su questo progetto, assicurati di avere:

1. **PHP >= 8.1**
2. **Composer** installato
3. **Node.js** e **npm** installati

## Istruzioni per l'Installazione

Per configurare il progetto sul tuo sistema, segui questi passaggi:

```bash
# Clona il repository
git clone <URL_DEL_REPOSITORY>

# Accedi alla directory del progetto
cd <NOME_CARTELLA_PROGETTO>

# Installa le dipendenze PHP
composer install

# Installa le dipendenze JavaScript
npm install

# Crea il file .env basato sull'esempio
cp .env.example .env

# Genera una nuova chiave di applicazione Laravel
php artisan key:generate

# Esegui le migrazioni per configurare il database
php artisan migrate

# Avvia il server di sviluppo
php artisan serve
```

Dopo questi passaggi, il progetto sarà accessibile all'indirizzo `http://localhost:8000`.

## Strumenti Utilizzati

- **Laravel**: Framework principale per la gestione del backend.
- **Vite**: Gestione delle risorse front-end.
- **Tailwind CSS**: Framework CSS per lo styling.
- **Axios**: Per la gestione delle richieste client-server.
- **npm**: Gestione dei package JavaScript.

---

Ci auguriamo che questa esperienza vi aiuti a comprendere meglio Laravel e a sviluppare progetti di successo in futuro.
Buono studio! 😊
