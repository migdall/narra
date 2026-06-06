# Museum Asset API & CMS Sandbox also known as Narra (Narrative Art Asset Management System)

A Laravel-based portfolio project demonstrating digital asset synchronization and API development. This sandbox was built to model the digital infrastructure needs of modern cultural institutions, specifically focusing on integrating a web CMS with a Digital Asset Management System (DAMS) and serving content to mobile applications.

## 🚀 Features

* **DAMS Synchronization:** Simulates a secure connection to a third-party API (NetX) to fetch and synchronize digital museum assets.
* **Idempotent Database Operations:** Utilizes Laravel's `updateOrCreate` to prevent duplicate records during recurring syncs.
* **Service-Oriented Architecture:** Extracts business logic into a dedicated `NetXSyncService` to keep controllers thin and make the code reusable for background cron jobs or web routes.
* **Robust Logging:** Includes built-in monitoring via Laravel's logging facilities to track sync successes and troubleshoot failures.
* **Secure Credential Management:** Implements best practices for API keys using `.env` variables mapped through cached configuration files.

## 🛠️ Tech Stack

* **Backend:** PHP, Laravel Framework
* **Database:** PostgreSQL (Configured via Eloquent ORM)
* **Tools:** Composer, Artisan CLI, Git

## 📋 Prerequisites

Before you begin, ensure you have the following installed on your local machine:

* PHP 8.2+
* Composer
* PostgreSQL
* Laravel Valet, Herd, or a similar local development environment

## 💻 Installation & Setup

**1. Clone the repository**

```bash
git clone https://github.com/migdall/narra.git
cd narra

```

**2. Install dependencies**

```bash
composer install

```

**3. Configure your environment**
Copy the example environment file and generate your application key:

```bash
cp .env.example .env
php artisan key:generate

```

Open the `.env` file, configure your database connection, and add the DAMS API sandbox credentials:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# NetX DAMS API Configuration
NETX_API_URL="https://api.mock-netx-dams.com/v1"
NETX_API_KEY="your-super-secret-api-key-here"

```

**4. Clear the config cache**
Ensure your application recognizes the new environment variables:

```bash
php artisan config:clear

```

**5. Run migrations and seeders**
Set up your database tables and populate them with initial mock data:

```bash
php artisan migrate:fresh --seed

```

## ⚙️ Usage

### Triggering the DAMS Sync

To manually trigger the NetX synchronization process, start your local server (`php artisan serve` if not using Valet/Herd) and navigate to the sync route in your browser:

`http://localhost:8000/netx-sync`

**Expected Output:**
You will receive a JSON response confirming the sync status:

```json
{
  "status": "success",
  "message": "Successfully synced 2 artworks from NetX."
}

```

You can verify the action by checking your database for the newly synced records or by reviewing the logs in `storage/logs/laravel.log`.

---

### 🧠 Architecture Highlights

* **`app/Services/NetXSyncService.php`:** Handles the heavy lifting of mapping DAMS payloads to the local database, complete with error handling and logging.
* **`config/services.php`:** Safely maps environment variables to application config, ensuring compatibility with production config caching.
