# 🎓 Online Classroom Management System

A comprehensive web-based classroom management platform built with PHP and MySQL, designed to streamline educational administration and enhance the learning experience for students, teachers, and administrators.

## 🌟 Features Overview

### 👨‍💼 Admin Features
- **User Management**: Create, edit, view, and delete user accounts with auto-generated emails and student IDs
- **Course Administration**: Manage courses, classes, and enrollment policies
- **Attendance Oversight**: Override attendance records and generate comprehensive reports
- **System Analytics**: Monitor platform usage, user statistics, and institutional data
- **Class Control**: Suspend/activate classes, modify settings, and manage capacity limits

### 👨‍🏫 Teacher Features
- **Assignment Management**: Create assignments with file attachments, due dates, and grading criteria
- **Submission Tracking**: View student submissions with completion statistics and download capabilities
- **Class Management**: Monitor enrolled students and class activities
- **Content Delivery**: Upload and organize course materials, syllabi, and resources
- **Progress Monitoring**: Track student attendance and academic performance

### 👨‍🎓 Student Features
- **Assignment Submission**: Submit assignments via text input or file upload
- **Course Materials**: Access and download syllabi, lecture notes, and learning resources
- **Progress Tracking**: Monitor grades, attendance records, and assignment status
- **Dashboard Overview**: View enrolled classes, pending assignments, and recent materials

## 🏗️ System Architecture

```
classroom-management/
├── 📁 app/
│   ├── 📁 controllers/         # Business logic handlers
│   │   ├── 📁 admin/          # Admin-specific controllers
│   │   ├── 📁 student/        # Student-specific controllers
│   │   └── 📁 teacher/        # Teacher-specific controllers
│   ├── 📁 models/             # Database interaction layer
│   │   ├── AssignmentModel.php # Assignment operations
│   │   ├── ClassModel.php     # Class management
│   │   ├── Database.php       # Database connection
│   │   ├── StudentModel.php   # Student operations
│   │   └── User.php           # User authentication
│   ├── 📁 uploads/            # File storage
│   │   └── 📁 assignments/    # Assignment submissions
│   └── 📁 views/              # User interface templates
│       ├── 📁 admin/          # Admin interface
│       ├── 📁 auth/           # Authentication pages
│       ├── 📁 student/        # Student interface
│       └── 📁 teacher/        # Teacher interface
├── 📁 public/
│   ├── 📁 css/               # Styling files
│   ├── 📁 assets/            # Images and icons
│   └── index.php             # Application entry point
└── 📁 uploads/               # Additional file storage
```

## 🛠️ Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript
- **Server**: Apache (XAMPP recommended)
- **Architecture**: MVC Pattern with role-based access control

## ⚙️ Installation & Setup

### Prerequisites
- XAMPP or similar PHP development environment
- MySQL database server
- Modern web browser

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/noor4964/online-classroom-management.git
   cd online-classroom-management
   ```

2. **Move to Web Directory**
   ```bash
   # For XAMPP users
   cp -r . /xampp/htdocs/classroom-management/
   ```

3. **Database Setup**
   - Start Apache and MySQL services in XAMPP
   - Create a new database named `classroom_management`
   - Import the database schema (SQL file should be provided)

4. **Configure Database Connection**
   ```php
   // Update app/models/Database.php with your credentials
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "classroom_management";
   ```

5. **Set File Permissions**
   ```bash
   # Ensure upload directories are writable
   chmod 755 uploads/
   chmod 755 app/uploads/
   ```

6. **Access the Application**
   - Navigate to `http://localhost/classroom-management/`
   - Use default admin credentials or create a new account

## 🔐 User Authentication System

### Auto-Generated Credentials

**Email Generation Rules:**
- **Teachers**: `firstname.lastname@aiub.edu`
- **Students**: `studentid@aiub.edu`
- **Admins**: `admin.firstname@aiub.edu`

**Student ID Format:**
- Pattern: `YY-XXXXX-X` (Year-Sequential-CheckDigit)
- Example: `25-00001-1` (2025, first student, check digit)

**Default Passwords:**
- **Teachers**: `teacher123`
- **Students**: `student123`
- **Admins**: `admin123`

## 📊 Database Schema

### Core Tables
- **users**: User accounts with role-based access
- **classes**: Course class information and settings
- **enrollments**: Student-class relationships
- **assignments**: Assignment details and requirements
- **assignment_submissions**: Student submission tracking
- **attendance**: Attendance records and statistics
- **content_materials**: Course materials and resources

### Key Relationships
```sql
users (1:N) classes        # Teacher can have multiple classes
classes (1:N) enrollments  # Class can have multiple students
assignments (1:N) assignment_submissions  # Assignment can have multiple submissions
classes (1:N) content_materials  # Class can have multiple materials
```

## 🎨 User Interface Design

### Design System
- **Color Palette**: Purple gradient theme (#667eea to #764ba2)
- **Layout**: Card-based design with consistent spacing
- **Typography**: Clean, readable fonts with proper hierarchy
- **Responsive**: Mobile-first approach with flexible grid systems

### Navigation Structure
```
Admin Panel:
├── Dashboard (system overview)
├── User Management (CRUD operations)
├── Course Management (course administration)
├── Class Oversight (class monitoring)
├── Attendance Management (attendance tracking)
└── Reports & Analytics (system insights)

Teacher Panel:
├── Dashboard (class overview)
├── My Classes (class management)
├── Assignment Management (create/track assignments)
├── Content Upload (material management)
├── Grades & Assessment (student evaluation)
└── Attendance Tracking (attendance management)

Student Panel:
├── Dashboard (personal overview)
├── My Classes (enrolled courses)
├── Assignments (view/submit assignments)
├── Course Materials (access resources)
├── Attendance Records (view attendance)
└── Profile Management (personal settings)
```

## 🔒 Security Features

### Authentication & Authorization
- **Session-based authentication** with secure logout
- **Role-based access control** (Admin/Teacher/Student)
- **Input validation** and sanitization
- **SQL injection prevention** through parameterized queries

### Data Protection
- **XSS protection** using `htmlspecialchars()`
- **File upload validation** for assignment submissions
- **Access logging** for admin actions
- **Secure file storage** with proper permissions

## 🚀 Key Functionalities

### Assignment Management
```php
// Teachers can create assignments with:
- Detailed instructions and requirements
- File attachments and supplementary materials
- Due dates and maximum points
- Grading criteria and visibility settings
- Real-time submission tracking

// Students can submit assignments via:
- Text-based submissions with rich formatting
- File uploads (PDF, DOC, images, etc.)
- Submission status tracking
- Download previous submissions
```

### Class Administration
```php
// Admins can:
- Override class settings and capacity limits
- Suspend/activate classes as needed
- Monitor enrollment and activity statistics
- Generate comprehensive reports

// Teachers can:
- View enrolled student lists
- Track class engagement and participation
- Upload course materials and resources
- Manage assignment distribution
```

### Reporting & Analytics
- **User activity reports** with engagement metrics
- **Attendance analytics** with trend analysis
- **Assignment completion statistics** per class
- **System usage dashboards** for administrators

## 📱 Responsive Design

### Mobile Optimization
```css
/* Responsive breakpoints for all devices */
@media (max-width: 768px) {
    /* Mobile-optimized layouts */
    /* Collapsible navigation menus */
    /* Touch-friendly button sizing */
}
```

### Cross-Browser Compatibility
- Modern browser support (Chrome, Firefox, Safari, Edge)
- Progressive enhancement for older browsers
- Consistent styling across platforms

## 🔄 Development Workflow

### Code Organization
- **MVC Architecture**: Clean separation of concerns
- **Modular Design**: Reusable components and functions
- **Consistent Naming**: Clear variable and function names
- **Documentation**: Inline comments and code documentation

### Quality Assurance
- **Input Validation**: Server-side and client-side validation
- **Error Handling**: Graceful error messages and recovery
- **Performance Optimization**: Efficient database queries
- **Security Testing**: Regular security audits and updates

## 🤝 Contributing

### Development Setup
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Code Standards
- Follow PSR-4 autoloading standards for PHP
- Use consistent indentation (4 spaces)
- Include proper documentation for new features
- Test all functionality before submitting

## 📄 License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## 👨‍💻 Author

**Noor Ahmad**
- GitHub: [@noor4964](https://github.com/noor4964)
- Project: [Online Classroom Management](https://github.com/noor4964/online-classroom-management)

## 🙏 Acknowledgments

- Thanks to the open-source community for inspiration and tools
- Educational institutions for requirements and feedback
- Contributors who helped improve the system

## 📞 Support

For support, email support@example.com or create an issue in the GitHub repository.

---

### 🎯 Future Enhancements

- [ ] Real-time notifications system
- [ ] Mobile application development
- [ ] Integration with external LMS platforms
- [ ] Advanced analytics and reporting
- [ ] Video conferencing integration
- [ ] Automated grading system
- [ ] Parent portal for K-12 institutions
- [ ] Multi-language support
- [ ] API development for third-party integrations
- [ ] Advanced security features (2FA, SSO)

---

**Built with ❤️ for educational excellence**