# **News Curator API Task**

### **Author:**
📌 **Olarewaju Mojeed**  
🔗 [GitHub Profile](https://github.com/Lowkey1729)

---

## **📌 Table of Contents**
- [Clone Repository](#clone-repository)
- [Install Dependencies](#install-dependencies)
- [Environment Setup](#environment-setup)
- [Run Code Locally](#run-code-locally)
- [Manage Migrations](#manage-migrations)
- [Run Test Cases](#run-test-cases)

---

## **🔹 Clone Repository**
Clone the repository into your local environment:

```bash
git clone https://github.com/Lowkey1729/laravel-news-curator-api.git
cd laravel-news-curator-api
```

---

## **🔹 Install Dependencies**
Run the following command to install required dependencies:

```bash
composer install
```

---

## **🔹 Environment Setup**

### **1️⃣ Create `.env` File**
Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

### **2️⃣ Create `.env.testing` File**
Copy `.env.example` to `.env.testing`:

```bash
cp .env.example .env.testing
```

### **3️⃣ Update Environment Variables**
Ensure the following configurations are properly set:
- Set `APP_ENV=testing` in `.env.testing`.
- Configure your **database credentials** and **table settings** in both `.env` and `.env.testing`.

---

## **🔹 Run Code Locally**
Start the Laravel development server:

```bash
php artisan serve
```

---

## **🔹 Manage Migrations**

Run migrations for the **default environment**:

```bash
php artisan migrate
```

Run migrations for the **testing environment**:

```bash
php artisan migrate --env=testing
```

---

## **🔹 Run Test Cases**
Execute the test suite using Pest:

```bash
./vendor/bin/pest
```

---

✅ **Now you’re all set!** 🚀
