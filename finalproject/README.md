# 🚴‍♂️ BikeShop - Bicycle E-commerce System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-v8.0+-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-v7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-v5.0+-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/MySQL-v5.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

<p align="center">
  <strong>ระบบจัดการร้านจักรยานออนไลน์ที่สมบูรณ์แบบ</strong><br>
  พัฒนาด้วย Laravel Framework พร้อมการจัดการสินค้า คำสั่งซื้อ และระบบ Admin ที่ทันสมัย
</p>

---

## 📋 Table of Contents

- [✨ Features](#-features)
- [🛠️ Technologies Used](#️-technologies-used)
- [📦 Installation](#-installation)
- [⚙️ Configuration](#️-configuration)
- [🚀 Usage](#-usage)
- [📁 Project Structure](#-project-structure)
- [🔒 Admin Panel](#-admin-panel)
- [📱 Responsive Design](#-responsive-design)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)

---

## ✨ Features

### 🛒 **E-commerce Core Features**
- **Product Management**: จัดการสินค้าจักรยานและอุปกรณ์
- **Category System**: ระบบจัดหมวดหมู่สินค้า
- **Order Management**: ระบบจัดการคำสั่งซื้อ
- **Inventory Tracking**: ติดตามสต็อกสินค้า
- **Search & Filter**: ค้นหาและกรองสินค้า

### 💼 **Admin Panel Features**
- **Dashboard**: หน้าแดชบอร์ดแสดงสถิติ
- **Product CRUD**: เพิ่ม แก้ไข ลบสินค้า
- **Category Management**: จัดการหมวดหมู่สินค้า
- **Order Processing**: ประมวลผลคำสั่งซื้อ
- **User Management**: จัดการผู้ใช้งาน

### 🎨 **UI/UX Features**
- **Modern Design**: ดีไซน์ทันสมัยด้วย Bootstrap 5
- **Responsive Layout**: รองรับทุกอุปกรณ์
- **Interactive Elements**: ปุ่มและฟอร์มที่โต้ตอบได้
- **Beautiful Pagination**: ระบบแบ่งหน้าที่สวยงาม
- **Loading Animations**: เอฟเฟ็คการโหลดที่น่าสนใจ

---

## 🛠️ Technologies Used

### **Backend**
- **Laravel 8.x** - PHP Web Framework
- **PHP 7.4+** - Server-side Programming
- **MySQL** - Database Management
- **Eloquent ORM** - Database Object-Relational Mapping

### **Frontend**
- **Blade Templates** - Laravel Templating Engine
- **Bootstrap 5** - CSS Framework
- **Font Awesome** - Icon Library
- **jQuery** - JavaScript Library
- **Custom CSS** - Modern Styling

### **Tools & Libraries**
- **Composer** - PHP Dependency Manager
- **NPM** - Node Package Manager
- **Laravel Mix** - Asset Compilation
- **Carbon** - Date Manipulation

---

## 📦 Installation

### **Prerequisites**
- PHP >= 7.4
- Composer
- MySQL/MariaDB
- Node.js & NPM

### **Step 1: Clone Repository**
```bash
git clone https://github.com/your-username/bikeshop.git
cd bikeshop/finalproject
```

### **Step 2: Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### **Step 3: Environment Setup**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### **Step 4: Database Setup**
```bash
# Create database (MySQL)
mysql -u root -p
CREATE DATABASE bikeshop_db;

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

### **Step 5: Compile Assets**
```bash
# Compile assets for development
npm run dev

# Or compile for production
npm run production
```

### **Step 6: Start Server**
```bash
# Start Laravel development server
php artisan serve

# Visit: http://localhost:8000
```

---

## ⚙️ Configuration

### **Database Configuration (.env)**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bikeshop_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### **Application Configuration**
```env
APP_NAME="BikeShop"
APP_ENV=local
APP_KEY=base64:your_generated_key
APP_DEBUG=true
APP_URL=http://localhost:8000
```

---

## 🚀 Usage

### **Admin Panel Access**
1. Navigate to `/admin` or use admin login
2. Default admin credentials (if seeded):
   - **Email**: admin@bikeshop.com
   - **Password**: password

### **Main Features Navigation**
- **Home**: `/` - หน้าแรก
- **Products**: `/product` - จัดการสินค้า
- **Categories**: `/category` - จัดการหมวดหมู่
- **Orders**: `/order` - จัดการคำสั่งซื้อ
- **Order Details**: `/orderdetail/{id}` - รายละเอียดคำสั่งซื้อ

---

## 📁 Project Structure

```
finalproject/
├── 📁 app/
│   ├── 📁 Http/Controllers/    # Controllers
│   ├── 📁 Models/             # Eloquent Models
│   └── 📁 Providers/          # Service Providers
├── 📁 database/
│   ├── 📁 migrations/         # Database Migrations
│   └── 📁 seeders/           # Database Seeders
├── 📁 public/
│   ├── 📁 css/               # Compiled CSS
│   ├── 📁 js/                # Compiled JavaScript
│   └── 📁 upload/            # Uploaded Files
├── 📁 resources/
│   ├── 📁 views/             # Blade Templates
│   │   ├── 📁 layouts/       # Layout Templates
│   │   ├── 📁 product/       # Product Views
│   │   ├── 📁 category/      # Category Views
│   │   ├── 📁 order/         # Order Views
│   │   └── 📁 custom/        # Custom Components
│   ├── 📁 css/               # Source CSS
│   └── 📁 js/                # Source JavaScript
├── 📁 routes/
│   ├── 📄 web.php            # Web Routes
│   └── 📄 api.php            # API Routes
└── 📄 composer.json          # PHP Dependencies
```

---

## 🔒 Admin Panel

### **Dashboard Features**
- 📊 Sales statistics
- 📈 Product inventory overview
- 📋 Recent orders
- 👥 User activity

### **Product Management**
- ➕ Add new products
- ✏️ Edit existing products
- 🗑️ Delete products
- 📸 Image upload
- 📦 Stock management

### **Order Management**
- 👀 View all orders
- 📝 Order details
- 🔄 Status updates
- 💰 Payment tracking

---

## 📱 Responsive Design

### **Breakpoints**
- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

### **Features**
- ✅ Mobile-first approach
- ✅ Touch-friendly interfaces
- ✅ Adaptive layouts
- ✅ Optimized images

---

## 🎨 UI Components

### **Custom Pagination**
- Beautiful modern design
- Animated hover effects
- Responsive layout
- Thai language support

### **Status Badges**
- Color-coded order status
- Animated interactions
- Icon integration
- Gradient backgrounds

### **Tables**
- Hover effects
- Responsive scrolling
- Action buttons
- Data formatting

---

## 🔧 Development

### **Code Style**
- Follow PSR-12 standards
- Use meaningful variable names
- Comment complex logic
- Maintain clean code structure

### **Database Design**
- **Users**: User authentication
- **Categories**: Product categories
- **Products**: Product information
- **Orders**: Order management
- **Order_Details**: Order line items

---

## 🤝 Contributing

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Commit** your changes (`git commit -m 'Add amazing feature'`)
4. **Push** to the branch (`git push origin feature/amazing-feature`)
5. **Open** a Pull Request

---

## 📞 Support

- **Developer**: Aum
- **Project**: Final Project BikeShop
- **Framework**: Laravel 8.x
- **Year**: 2025

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

<p align="center">
  <strong>🚴‍♂️ Happy Cycling with BikeShop! 🚴‍♀️</strong><br>
  <em>Built with ❤️ using Laravel Framework</em>
</p>

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
