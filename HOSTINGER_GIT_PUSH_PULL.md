# 🚀 Hostinger Git Push & Pull Complete Setup Guide (Roman Urdu)

Yeh guide **VELORA Premium Store** ke liye hai taake aap apne local computer se changes GitHub par bhej sakein (PUSH) aur phir Hostinger par live update pull kar sakein (PULL).

* **Local Project Path:** `"C:\xampp\htdocs\my project\velstore\velstore-main"`
* **GitHub Repository:** `https://github.com/malikumairnaich40-create/velora-store.git`
* **Default Branch:** `main`

---

## 📌 PART A: PUSH (Local Computer Se GitHub Par)

Jab bhi aap apne local computer (VS Code ya laptop) par koi naya feature banayein, code change karein ya design update karein, to GitHub par push karne ka tareeqa:

### Step 1: Terminal / Command Prompt Kholein
Apne PC par CMD ya PowerShell open karein aur project directory me jayein:
```bash
cd "C:\xampp\htdocs\my project\velstore\velstore-main"
```
*(Path me space hai is liye double quotes `""` zaroor lagayein).*

### Step 2: Git Status Check Karein (Optional)
Dekhne ke liye ke kon kon si files change hui hain:
```bash
git status
```

### Step 3: Files Ko Stage Karein
Tamam modified aur new files ko Git staging me add karein:
```bash
git add .
```

### Step 4: Commit Karein
Apne kaam ka short message likh kar commit karein:
```bash
git commit -m "update: your message here"
```
*(Example: `git commit -m "Added product filter and new banner"`)*

### Step 5: GitHub Par Push Karein
Code ko GitHub repository ke `main` branch par bhej dein:
```bash
git push origin main
```

> **Note:** Ab aapka local code GitHub par mehfooz (safe backup) ho gaya hai.

---

## 🌐 PART B: PULL (GitHub Se Hostinger Server Par)

GitHub par naya code push karne ke baad, Hostinger par website update karne ke 2 tareeqay hain:

---

### Tareeqa 1: Hostinger hPanel GUI (Baghair Coding / Easy Way)

Agar aap SSH terminal use nahi karna chahte, to Hostinger panel ke andar se Git automate kar sakte hain:

#### Step 1: Hostinger hPanel Me Login Karein
1. [hostinger.com](https://hostinger.com) par login karein.
2. Apne Hosting account me jayein aur domain ke samne **Manage** par click karein.

#### Step 2: Git Section Kholein
1. Left sidebar me scroll karein aur **Advanced** category par click karein.
2. **Git** option par click karein.

#### Step 3: Repository Setup (Pehli Baar Sirf)
Agar pehli dafa setup kar rahe hain:
1. **Repository:** `https://github.com/malikumairnaich40-create/velora-store.git`
2. **Branch:** `main`
3. **Install Directory:** 
   * Agar primary domain hai: `public_html`
   * Agar addon domain ya subdomain hai: `domains/yourdomain.com/public_html`
4. **Create / Deploy** par click karein. Hostinger automatically GitHub se files download kar lega.

#### Step 4: Aainda Updates (Future Pulls)
Jab bhi aap PART A me GitHub par push karein:
1. Wapis **hPanel > Advanced > Git** me jayein.
2. Apni repository ke samne **"Deploy"** ya **"Pull Latest"** button par click karein.
3. Hostinger foran latest code pull kar lega!

---

### Tareeqa 2: Hostinger SSH Terminal (Recommended & Professional)

Laravel me sirf git pull kaafi nahi hota, database migrate karna, cache clear karna aur storage link banana zaroori hota hai. Is liye SSH terminal behtareen tareeqa hai.

#### Step 1: Hostinger Me SSH Enable Karein
1. Hostinger hPanel me **Advanced > SSH Access** par jayein.
2. SSH Status ko **Enabled** karein.
3. Wahan aapko yeh details milengi:
   * **SSH IP / Host:** (e.g. `123.45.67.89`)
   * **SSH Port:** `65002` *(Hostinger default port 65002 use karta hai)*
   * **SSH Username:** `u123456789`
   * **Password:** Aapke hosting account ka password

#### Step 2: Apne PC Se SSH Connect Karein
Apne computer par Windows Terminal, PowerShell ya PuTTY open karein aur yeh command chalayein:
```bash
ssh -p 65002 u123456789@YOUR_SERVER_IP
```
*(Apna username aur server IP replace karein, phir Enter daba kar password enter karein).*

#### Step 3: Project Folder Me Jayein
SSH me login hone ke baad apne website folder me jayein:
```bash
cd domains/yourdomain.com/public_html
```
*(Agar single domain hai to `cd public_html` chalayein).*

#### Step 4: Git Pull Aur Laravel Commands Chalayein
Yeh commands baari baari chalayein:

1. **Latest Code Pull Karein:**
   ```bash
   git pull origin main
   ```

2. **Composer Dependencies Install Karein:**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

3. **Database Migrations Run Karein:**
   ```bash
   php artisan migrate --force
   ```

4. **Storage Link Check Karein:**
   ```bash
   php artisan storage:link
   ```

5. **Cache Clear Aur Optimize Karein:**
   ```bash
   php artisan optimize:clear
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

6. **Permissions Set Karein:**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

---

### ⚡ Shortcut: 1-Click Auto Deployment Script (`deploy.sh`)

Aapke project me `deploy.sh` script create kar di gayi hai!
Aapko upar wali 6 commands alag alag likhne ki zaroorat nahi.

Hostinger SSH terminal me bas yeh ek command chalayein:
```bash
bash deploy.sh
```
Yeh script automatically:
* Git se code pull karegi
* Composer optimize karegi
* Database migrate karegi
* Storage link banayegi
* Cache clear & optimize karegi
* Permissions 775 set karegi

---

## 🛠️ Pehli Baar Deployment Ke Zaroori Kaam (Checklist)

Jab aap Hostinger par pehli dafa deploy karne lagen:
1. **`.env` File:** Hostinger file manager me project root par `.env` file banayein (Aap `.env.hostinger` ko copy karke `.env` rename kar sakte hain) aur Hostinger MySQL database details daalein.
2. **App Key Generate:** SSH me `php artisan key:generate` chalayein.
3. **Database Import:** Local database `velstore` ka SQL export le kar Hostinger phpMyAdmin me import karein ya `php artisan migrate --force --seed` chalayein.
4. **Root `.htaccess`:** Hostinger par Laravel chalane ke liye root `.htaccess` already project me include hai jo tamam requests ko `public/` folder par safely route karta hai.

---

## 📋 Summary Cheat Sheet

| Action | Location | Command |
|---|---|---|
| **Save & Push** | Local PC | `cd "C:\xampp\htdocs\my project\velstore\velstore-main"`<br>`git add .`<br>`git commit -m "update"`<br>`git push origin main` |
| **Pull Update (GUI)** | Hostinger hPanel | Advanced > Git > Click **Deploy / Pull Latest** |
| **Pull Update (SSH)** | Hostinger SSH | `cd public_html && bash deploy.sh` |
