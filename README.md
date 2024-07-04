### Project Overview

Welcome to the Ticketing System for SDLC and Bug Reporting! This project is designed to streamline the software development lifecycle (SDLC) and bug reporting processes. It provides a comprehensive platform for managing projects, tracking tasks, reporting bugs, and ensuring effective communication among team members. Built using Yii Framework, with MSSQL as the database and hosted on IIS, this system aims to improve productivity and collaboration within development teams.

### Key Features

- **Project Management**: Create and manage projects, tasks, and milestones efficiently.
- **Bug Reporting**: Report, track, and resolve bugs with ease.
- **User Management**: Handle user creation, role assignment, and permission management.
- **Notifications Management**: Configure in-app notifications, email templates, and notification settings.
- **Reporting and Analytics**: Generate detailed reports and analytics for informed decision-making.
- **Health Support**: Monitor system health, manage incidents, and perform regular maintenance.

### Admin Module Overview

The Admin Module is a crucial part of this system, providing various tools and functionalities to ensure smooth operation, security, and configuration of the platform. Below is a detailed description of the components within the Admin Module:

#### User Management

- **User Creation and Management**: Interface to add new users, edit existing user information, deactivate/reactivate users, and delete users.
- **Role and Permission Management**: Interface to create roles, assign permissions to roles, and assign roles to users.
- **User Activity Tracking**: View logs of user activities such as login times and actions performed.
- **User Profiles**: Interface to view and edit user details like name, email, and profile picture.

#### Project Management

- **Project Creation and Management**: Create, edit, and archive/delete projects.
- **Task Management**: Add, edit, and track tasks within projects.
- **Milestone Management**: Add, edit, and track milestones within projects.
- **Project Documentation and Files**: Upload and manage project documentation and files.
- **Project Reporting and Analytics**: Generate reports and view analytics for projects.
- **Project Notifications**: Set up and manage project-specific notifications.

#### System Configuration

- **Configure System Settings**: Update system name, default language, time zone, and notification preferences.
- **Manage Integrations**: Set up and manage integrations with external services like GitHub, Slack, and Jira.

#### Security Management

- **Set Security Policies**: Configure password requirements, account lockout thresholds, and session timeouts.
- **Manage Access Controls**: Define and manage access control rules such as IP restrictions and two-factor authentication requirements.

#### Audit Logs

- **View Audit Logs**: Access logs of user actions and system events.
- **Export Audit Logs**: Export logs for further analysis or compliance purposes.

#### System Maintenance

- **Schedule System Backups**: Configure and schedule regular system backups.
- **Run System Diagnostics**: Perform system diagnostics to identify and resolve issues.

#### Notifications Management

- **In-App Notifications**: Set up and manage notifications for in-app events like new tasks assigned or project updates.
- **Notification Settings**: Configure global notification preferences and manage user-specific settings.
- **Email Templates**: Create, edit, and test email templates for system notifications.

#### API Management

- **Create API Keys**: Generate and manage API keys for accessing system data programmatically.
- **Manage API Keys**: Edit or revoke existing API keys as necessary.

#### Localization Management

- **Manage Languages**: Add new languages and manage translations for the system.
- **Edit Translations**: Update translations for various system messages and labels.

#### Data Management

- **Data Import**: Import data such as users and projects from external files.
- **Data Export**: Export system data for backup or migration purposes.

#### Health Support

- **System Health Monitoring**: Set up and view system health metrics like CPU usage, memory usage, and disk space.
- **Incident Management**: Report and track incidents affecting system performance.
- **Alert Management**: Set up and manage alerts for system health conditions.
- **Maintenance Scheduling**: Schedule and manage regular system maintenance tasks.
- **Performance Optimization**: Analyze and optimize system performance based on collected metrics.
- **Backup and Recovery**: Configure backup settings and perform data recovery operations.
- **User Support and Documentation**: Access support resources and submit support tickets for assistance.

This Admin Module ensures that the system remains secure, well-configured, and efficiently maintained, supporting the overall goal of improving productivity and collaboration in software development and bug reporting processes.

### Setting Up Using Yii Basic

Follow these steps to set up the Ticketing System using Yii Basic:

#### Prerequisites

- PHP 7.2 or higher
- Composer
- MSSQL database
- IIS (Internet Information Services)

#### Installation Steps

1. **Download Yii Basic Project Template**:
   - Open your terminal or command prompt.
   - Run the following command to create a new Yii basic application:
     ```bash
     composer create-project --prefer-dist yiisoft/yii2-app-basic ticketing-system
     ```

2. **Set Up Database**:
   - Create a new database in MSSQL for the application.
   - Update the `config/db.php` file with your database connection details:
     ```php
     return [
         'class' => 'yii\db\Connection',
         'dsn' => 'sqlsrv:Server=your_server_name;Database=your_database_name',
         'username' => 'your_username',
         'password' => 'your_password',
         'charset' => 'utf8',
     ];
     ```

3. **Run Migrations**:
   - Navigate to the project directory:
     ```bash
     cd ticketing-system
     ```
   - Run the following command to apply migrations and set up the database tables:
     ```bash
     php yii migrate
     ```

4. **Configure Web Server (IIS)**:
   - Set up a new site in IIS and point it to the `web` directory of your Yii application.
   - Ensure that PHP is configured correctly in IIS.

5. **Set Up Permissions**:
   - Ensure that the `runtime` and `web/assets` directories are writable by the web server.

6. **Test the Application**:
   - Open a web browser and navigate to the URL where your IIS site is hosted (e.g., http://localhost/ticketing-system/web).
   - You should see the Yii welcome page. 

7. **Configure Application Components**:
   - Customize application configurations such as `config/web.php` and `config/console.php` to suit your environment and requirements.

8. **Deploy the Application**:
   - Once configured and tested locally, deploy the application to your production environment following best practices for Yii applications.

### Contributing

We welcome contributions to the Ticketing System project. Please follow these steps to contribute:

1. Fork the repository on GitHub.
2. Create a new branch for your feature or bugfix.
3. Make your changes and commit them with descriptive commit messages.
4. Push your changes to your forked repository.
5. Open a pull request to the main repository.

### License

This project is licensed under the MIT License. See the LICENSE file for more details.

Thank you for using the Ticketing System for SDLC and Bug Reporting! We hope this system enhances your development workflow and improves collaboration within your team.
