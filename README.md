# 🚴‍♂️ BikeShop - Bicycle E-commerce System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-v10.0+-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-v8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-v5.1+-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/MySQL-v5.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Docker-Ready-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker">
</p>

<p align="center">
  <strong>ระบบจัดการร้านจักรยานออนไลน์ที่สมบูรณ์แบบ</strong><br>
  พัฒนาด้วย Laravel 10 Framework พร้อมการจัดการสินค้า คำสั่งซื้อ และระบบ Admin ที่ทันสมัย<br>
  <em>พร้อมรองรับการ Deploy บน Railway และ Docker</em>
</p>

---

## 📋 Table of Contents

- [✨ Features](#-features)
- [🛠️ Technologies Used](#️-technologies-used)
- [📦 Installation](#-installation)
- [🐳 Docker Deployment](#-docker-deployment)
- [☁️ Railway Deployment](#️-railway-deployment)
- [⚙️ Configuration](#️-configuration)
- [🚀 Usage](#-usage)
- [📁 Project Structure](#-project-structure)
- [🔒 Admin Panel](#-admin-panel)
- [🛒 Shopping Features](#-shopping-features)
- [📱 Responsive Design](#-responsive-design)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)

---

## ✨ Features

### 🛒 **E-commerce Core Features**
- **Product Management**: จัดการสินค้าจักรยานและอุปกรณ์ครบวงจร
- **Category System**: ระบบจัดหมวดหมู่สินค้าที่ยืดหยุ่น
- **Shopping Cart**: ระบบตะกร้าสินค้าที่ใช้งานง่าย
- **Order Management**: ระบบจัดการคำสั่งซื้อแบบครบวงจร
- **Order Status Tracking**: ติดตามสถานะคำสั่งซื้อแบบ Real-time
- **Inventory Tracking**: ติดตามสต็อกสินค้าอัตโนมัติ
- **Search & Filter**: ค้นหาและกรองสินค้าอย่างรวดเร็ว
- **PDF Invoice Generation**: สร้างใบเสร็จ/ใบกำกับภาษีแบบ PDF

### 💼 **Admin Panel Features**
- **Modern Dashboard**: หน้าแดชบอร์ดแสดงสถิติแบบ Real-time
- **Product CRUD**: เพิ่ม แก้ไข ลบสินค้าพร้อมอัปโหลดรูปภาพ
- **Category Management**: จัดการหมวดหมู่สินค้า
- **Order Processing**: ประมวลผลและอัปเดตสถานะคำสั่งซื้อ
- **User Management**: จัดการผู้ใช้งานระบบ
- **Order Details View**: ดูรายละเอียดคำสั่งซื้อแบบละเอียด

### 🔐 **Authentication & Security**
- **User Registration**: ระบบลงทะเบียนผู้ใช้
- **Login/Logout**: ระบบเข้าสู่ระบบและออกจากระบบ
- **Password Reset**: ระบบรีเซ็ตรหัสผ่าน
- **Email Verification**: ยืนยันอีเมลผู้ใช้
- **Session Management**: จัดการ Session อย่างปลอดภัย

### 🎨 **UI/UX Features**
- **Modern Design**: ดีไซน์ทันสมัยด้วย Bootstrap 5
- **Responsive Layout**: รองรับทุกอุปกรณ์ (Mobile, Tablet, Desktop)
- **Interactive Elements**: ปุ่มและฟอร์มที่โต้ตอบได้
- **Beautiful Pagination**: ระบบแบ่งหน้าที่สวยงาม
- **Form Validation**: ตรวจสอบข้อมูลฟอร์มแบบ Real-time
- **Toast Notifications**: แจ้งเตือนแบบ Toast Messages
- **Icon Integration**: ใช้ Font Awesome Icons

---

## 🛠️ Technologies Used

### **Backend**
- **Laravel 10.x** - PHP Web Framework
- **PHP 8.2+** - Server-side Programming
- **MySQL** - Database Management
- **Eloquent ORM** - Database Object-Relational Mapping
- **mPDF 8.2** - PDF Generation Library

### **Frontend**
- **Blade Templates** - Laravel Templating Engine
- **Bootstrap 5.1+** - CSS Framework
- **Font Awesome 6.5** - Icon Library
- **jQuery 3.7** - JavaScript Library
- **Toastr** - Toast Notification Library
- **Custom CSS** - Modern Styling

### **DevOps & Deployment**
- **Docker** - Containerization
- **Dockerfile** - Multi-stage build configuration
- **Nginx** - Web Server
- **PHP-FPM** - FastCGI Process Manager
- **Railway** - Cloud Platform Deployment

### **Tools & Libraries**
- **Composer** - PHP Dependency Manager
- **NPM** - Node Package Manager
- **Laravel Mix** - Asset Compilation
- **Carbon** - Date Manipulation

---

## 📦 Installation

### **Prerequisites**
- PHP >= 8.2
- Composer
- MySQL/MariaDB >= 5.7
- Node.js >= 16.x & NPM
- Git

### **Step 1: Clone Repository**
```bash
git clone https://github.com/your-username/bikeshop.git
cd bikeshop/finalproject_bikeshop-1
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

# Update .env file with database credentials
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=bikeshop_db
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

### **Step 5: Storage Setup**
```bash
# Create storage link
php artisan storage:link

# Set permissions
chmod -R 775 storage bootstrap/cache
```

### **Step 6: Compile Assets**
```bash
# Compile assets for development
npm run dev

# Or compile for production
npm run production
```

### **Step 7: Start Server**
```bash
# Start Laravel development server
php artisan serve

# Visit: http://localhost:8000
```

---

## 🐳 Docker Deployment

### **Build Docker Image**
```bash
docker build -t bikeshop:latest .
```

### **Run Container**
```bash
docker run -d \
  -p 8080:8080 \
  -e DB_HOST=your_db_host \
  -e DB_DATABASE=bikeshop_db \
  -e DB_USERNAME=your_username \
  -e DB_PASSWORD=your_password \
  --name bikeshop \
  bikeshop:latest
```

### **Docker Compose (Optional)**
สร้างไฟล์ `docker-compose.yml` สำหรับรันทั้ง Application และ Database

---

## ☁️ Railway Deployment

### **Prerequisites**
- Railway account
- GitHub repository connected

### **Deployment Steps**
1. สร้างโปรเจคใหม่บน Railway
2. เชื่อมต่อ GitHub repository
3. เพิ่ม MySQL Database service
4. ตั้งค่า Environment Variables:
   - `DB_HOST` - Database host
   - `DB_DATABASE` - Database name
   - `DB_USERNAME` - Database username
   - `DB_PASSWORD` - Database password
   - `APP_KEY` - Application key
   - `APP_URL` - Application URL
5. Deploy อัตโนมัติ

### **Health Check**
Railway จะตรวจสอบ health endpoint ที่ `/health` อัตโนมัติ

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
APP_ENV=production
APP_KEY=base64:your_generated_key
APP_DEBUG=false
APP_URL=https://your-domain.com
```

### **Mail Configuration (Optional)**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@bikeshop.com
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🚀 Usage

### **Admin Panel Access**
1. Navigate to `/login` หรือ `/register`
2. สร้างบัญชีใหม่หรือใช้บัญชีที่มีอยู่
3. Default admin credentials (if seeded):
   - **Email**: admin@bikeshop.com
   - **Password**: password

### **Main Features Navigation**
- **Home**: `/home` - หน้าแรกแสดงสินค้า
- **Products**: `/product` - จัดการสินค้า (CRUD)
- **Categories**: `/category` - จัดการหมวดหมู่ (CRUD)
- **Users**: `/user` - จัดการผู้ใช้ (CRUD)
- **Orders**: `/order` - ดูรายการคำสั่งซื้อ
- **Order Details**: `/orderdetail/{id}` - รายละเอียดคำสั่งซื้อ
- **Cart**: `/cart/view` - ดูตะกร้าสินค้า
- **Checkout**: `/cart/checkout` - หน้าชำระเงิน

### **Shopping Flow**
1. ดูสินค้าที่หน้าแรก (`/home`)
2. เพิ่มสินค้าเข้าตะกร้า (`/cart/add/{id}`)
3. ดูตะกร้าสินค้า (`/cart/view`)
4. ตรวจสอบและชำระเงิน (`/cart/checkout`)
5. ยืนยันคำสั่งซื้อ (`/cart/complete`)
6. ดูรายการคำสั่งซื้อ (`/order`)

---

## 📁 Project Structure

```
finalproject_bikeshop-1/
├── 📁 app/
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/         # Controllers
│   │   │   ├── 📁 Api/             # API Controllers
│   │   │   └── 📁 Auth/           # Authentication Controllers
│   │   └── 📁 Middleware/         # Custom Middleware
│   ├── 📁 Models/                  # Eloquent Models
│   └── 📁 Providers/               # Service Providers
├── 📁 database/
│   ├── 📁 migrations/              # Database Migrations
│   ├── 📁 seeders/                 # Database Seeders
│   └── 📁 factories/               # Model Factories
├── 📁 public/
│   ├── 📁 css/                     # Compiled CSS
│   ├── 📁 js/                      # Compiled JavaScript
│   ├── 📁 upload/                  # Uploaded Files
│   └── 📁 vendor/                  # Third-party Assets
├── 📁 resources/
│   ├── 📁 views/                   # Blade Templates
│   │   ├── 📁 layouts/            # Layout Templates
│   │   ├── 📁 product/            # Product Views
│   │   ├── 📁 category/           # Category Views
│   │   ├── 📁 order/              # Order Views
│   │   ├── 📁 user/               # User Views
│   │   ├── 📁 cart/               # Cart Views
│   │   └── 📁 auth/               # Authentication Views
│   ├── 📁 css/                    # Source CSS
│   └── 📁 js/                     # Source JavaScript
├── 📁 routes/
│   ├── 📄 web.php                 # Web Routes
│   └── 📄 api.php                 # API Routes
├── 📁 storage/
│   ├── 📁 app/                    # Application Storage
│   └── 📁 logs/                   # Log Files
├── 📄 Dockerfile                  # Docker Configuration
├── 📄 railway.json                # Railway Configuration
├── 📄 composer.json               # PHP Dependencies
└── 📄 package.json                # Node Dependencies
```

---

## 🔒 Admin Panel

### **Dashboard Features**
- 📊 Sales statistics
- 📈 Product inventory overview
- 📋 Recent orders
- 👥 User activity

### **Product Management**
- ➕ Add new products with image upload
- ✏️ Edit existing products
- 🗑️ Delete products
- 📸 Image upload and management
- 📦 Stock quantity management
- 💰 Price management

### **Category Management**
- ➕ Add new categories
- ✏️ Edit categories
- 🗑️ Delete categories
- 🔍 Search categories

### **User Management**
- 👀 View all users
- ✏️ Edit user information
- ➕ Add new users
- 🗑️ Delete users
- 🔍 Search users

### **Order Management**
- 👀 View all orders
- 📝 Order details with PDF export
- 🔄 Status updates (Pending, Processing, Completed)
- 💰 Payment tracking
- 📧 Order notifications

---

## 🛒 Shopping Features

### **Product Catalog**
- แสดงสินค้าทั้งหมดพร้อมรูปภาพ
- ค้นหาสินค้า
- กรองตามหมวดหมู่
- แสดงราคาและสต็อก

### **Shopping Cart**
- เพิ่มสินค้าเข้าตะกร้า
- แก้ไขจำนวนสินค้า
- ลบสินค้าออกจากตะกร้า
- คำนวณราคารวมอัตโนมัติ

### **Checkout Process**
- ระบุที่อยู่จัดส่ง
- ระบุเบอร์โทรศัพท์
- ยืนยันคำสั่งซื้อ
- สร้างใบเสร็จ PDF

### **Order Tracking**
- ดูรายการคำสั่งซื้อ
- ดูรายละเอียดคำสั่งซื้อ
- ติดตามสถานะคำสั่งซื้อ

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
- ✅ Responsive tables
- ✅ Mobile navigation menu

---

## 🎨 UI Components

### **Modern Form Design**
- Bootstrap 5 form controls
- Real-time validation
- Icon integration
- Placeholder hints
- Error messages

### **Custom Cards**
- Shadow effects
- Rounded corners
- Header sections
- Responsive layout

### **Status Badges**
- Color-coded order status
- Animated interactions
- Icon integration

### **Tables**
- Hover effects
- Responsive scrolling
- Action buttons
- Data formatting

### **Pagination**
- Beautiful modern design
- Animated hover effects
- Responsive layout
- Thai language support

---

## 🔧 Development

### **Code Style**
- Follow PSR-12 standards
- Use meaningful variable names
- Comment complex logic
- Maintain clean code structure

### **Database Design**
- **Users**: User authentication and management
- **Categories**: Product categories
- **Products**: Product information with images
- **Orders**: Order management with address and phone
- **Order_Details**: Order line items with quantities

### **API Endpoints (Available)**
- `/api/product` - Product list API
- `/api/category` - Category list API
- `/api/product/{category_id}` - Products by category

---

## 🐛 Troubleshooting

### **Common Issues**

**Database Connection Error**
- ตรวจสอบ `.env` configuration
- ตรวจสอบว่า MySQL service ทำงานอยู่
- ตรวจสอบ credentials

**Storage Permission Error**
```bash
chmod -R 775 storage bootstrap/cache
```

**Composer Install Error**
```bash
composer install --no-interaction --prefer-dist
```

**NPM Build Error**
```bash
npm install --legacy-peer-deps
npm run production
```

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
- **Framework**: Laravel 10.x
- **Year**: 2025
- **License**: MIT License

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

<p align="center">
  <strong>🚴‍♂️ Happy Cycling with BikeShop! 🚴‍♀️</strong><br>
  <em>Built with ❤️ using Laravel 10 Framework</em>
</p>

---

## 🙏 Acknowledgments

- Laravel Framework Community
- Bootstrap Team
- Font Awesome
- All Contributors

---

**Note**: This is a final project for educational purposes. For production use, please ensure proper security measures, error handling, and testing are implemented.
