<!DOCTYPE html>
<html lang="en">
<body>

<h2>Developed by IT482 (Steve Quinn, Chris Hunter, Tim Guerin)</h2>

<h2>PowerSupply App Documentation</h2>

<h3>Introduction</h3>

<h5>1.1 Purpose</h5>

<h5>1.2 Features</h5>

<h5>1.3 Technology Stack</h5>

<h3>Installation</h3>

<h5>2.1 Prerequisites</h5>

<h5>2.2 Setup</h5>

<h3>User Guide</h3>

<h5>3.1 Account Creation and Login</h5>

<h5>3.2 Dashboard</h5>

<h5>3.3 Barcode Scanning</h5>

<h5>3.4 Reorder Notification</h5>

<h5>3.5 Trending Analysis and Forecasting</h5>

<h5>3.6 User Administration</h5>

<h3>AWS Integration</h3>

<h5>4.1 Database Configuration</h5>

<h5>4.2 Storage and Security</h5>

<h3>Troubleshooting</h3>

<h5>5.1 Backend Issues (Laravel)</h5>

<h5>5.2 Frontend Issues (Angular)</h5>

<h5>5.3 AWS Services</h5>

<h3>A Message From the Developers</h3>

</p>
<h2>1. Introduction</h2>

<h3>1.1 Background and Purpose</h3>
<p>
    The Laravel-based Angular web application for inventory management is designed to provide first responders with an intuitive and efficient solution to track, analyze, and manage inventory levels. This documentation serves as a comprehensive guide for users, administrators, and developers. The primary objective of the Inventory Management System is to offer first responders a robust platform for overseeing their equipment and supplies. The system aims to streamline the inventory management process, enhance decision-making through data analysis, and ensure the timely replenishment of essential items.
</p>

<h3>1.2 Features</h3>
<p>
    <strong>User Authentication:</strong>
    <br>
    Users can create accounts securely, and the system employs industry-standard authentication practices to protect sensitive information.
    <br>
<p>
    <strong>Dashboard:</strong>
    <br>
    The intuitive dashboard provides an overview of current inventory levels through visually appealing graphs and charts. This feature enables users to quickly assess the status of their resources.
    <br>
</p>
<h3>1.3 Technology Stack</h3>
<p>
    The technology stack combines the power of Angular for the frontend, Laravel for the backend, and AWS services for database storage and deployment. This robust stack ensures scalability, security, and optimal performance.
    <br>
</p>

<h2>2. Installation</h2>

<h3>2.1 Prerequisites</h3>
<p>
    Before initiating the installation process, ensure that PHP and Composer are installed for Laravel, and Node.js along with npm for Angular. Additionally, set up an AWS account to leverage cloud services for database storage and deployment.
    <br>
</p>


<h3>2.2 Setup</h3>
<p>
    <strong>Clone the Repository:</strong>
    <br>
    Execute the following command: gh repo clone squinn8810/ims-app
    <br>
    <button onclick="copyCode('cloneRepoCode')">Copy Code</button>
</p>
<pre id="cloneRepoCode">
gh repo clone squinn8810/ims-app</pre>

<p>
    <strong>Install Laravel Dependencies:</strong>
    <br>
    Navigate to the Laravel project directory and run: 
    <br>
    <button onclick="copyCode('laravelDepsCode')">Copy Code</button>
</p>
<pre id="laravelDepsCode">
composer install
</pre>
<p>
    <strong>Install Angular Dependencies:</strong>
    <br>
    Navigate to the Angular project directory and run: 
    <br>
    <button onclick="copyCode('angularDepsCode')">Copy Code</button>
</p>
<pre id="angularDepsCode">npm install</pre>

<p>
    <strong>Build Angular Project:</strong>
    <br>
    Generate the Angular production build:
    <br>
    <button onclick="copyCode('angularBuildCode')">Copy Code</button>
</p>
<pre id="angularBuildCode">
ng build --prod</pre>

<p>
    <strong>Configure AWS Services:</strong>
    <br>
    Utilize AWS RDS for database configuration, ensuring Laravel is set up to connect to the AWS database.
    <br>
    <button onclick="copyCode('awsConfigCode')">Copy Code</button>
</p>
<p>
    <strong>Deploy the application to AWS:</strong>
    <br>
    Use appropriate services such as Elastic Beanstalk or EC2.
    <br>
    <button onclick="copyCode('awsDeployCode')">Copy Code</button>
</p>

<h2>3. User Guide</h2>

<h3>3.1 Account Creation and Login</h3>
<p>
    To get started with the Inventory Management System:
</p>
<ul>
    <li>
        <strong>Visit the Application URL:</strong>
        <br>
        Open your web browser and enter the URL provided.
    </li>
    <li>
        <strong>Register an Account:</strong>
        <br>
        Click on the "Register" button.
        <br>
        Complete the registration form with the required details.
    </li>
    <li>
        <strong>Login:</strong>
        <br>
        Use your registered credentials to log in securely.
    </li>
</ul>

<h3>3.2 Dashboard</h3>
<p>
    Upon successful login, users can navigate to the comprehensive dashboard:
</p>
<ul>
    <li>
        <strong>Real-Time Inventory Levels:</strong>
        <br>
        The dashboard displays real-time inventory levels using intuitive charts and graphs.
    </li>
    <li>
        <strong>Visual Representation:</strong>
        <br>
        Graphical elements provide a quick and visually appealing overview of inventory status.
    </li>
</ul>

<h3>3.3 Barcode Scanning</h3>
<p>
    The Barcode Scanning feature simplifies inventory management:
</p>
<ul>
    <li>
        <strong>Access from Dashboard:</strong>
        <br>
        Navigate to the designated section from the dashboard.
    </li>
    <li>
        <strong>Scan Barcodes:</strong>
        <br>
        Utilize a device camera to scan barcodes on items.
    </li>
    <li>
        <strong>Reorder Trigger:</strong>
        <br>
        Efficiently trigger reorder notifications based on scanned data.
    </li>
</ul>

<h3>3.4 Reorder Notification</h3>
<p>
    Receive timely notifications for low inventory levels:
</p>
<ul>
    <li>
        <strong>Notification Prompt:</strong>
        <br>
        Instant notifications alert users about low-stock situations.
        <br>
        Identifies items that need to be reordered as well as vendor information.
    </li>
    <li>
        <strong>Reorder Confirmation:</strong>
        <br>
        Confirm reorders directly from the notification interface.
    </li>
</ul>

<h3>3.5 Trending Analysis and Forecasting</h3>
<p>
    Explore historical data and forecast future needs:
</p>
<ul>
    <li>
        <strong>Analysis Section:</strong>
        <br>
        Access the dedicated section for trending analysis.
    </li>
    <li>
        <strong>Historical Trends:</strong>
        <br>
        View and analyze historical trends in inventory usage.
    </li>
    <li>
        <strong>Forecasting:</strong>
        <br>
        Leverage forecasting algorithms for future inventory needs.
    </li>
</ul>

<h3>3.6 User Administration</h3>
<p>
    Efficiently manage user roles and permissions:
</p>
<ul>
    <li>
        <strong>Admin Privileges:</strong>
        <br>
        Administrators can assign and modify user roles.
    </li>
    <li>
        <strong>Access Levels:</strong>
        <br>
        Ensure that different team members have appropriate levels of access for data security.
    </li>
</ul>

4. AWS Integration

<h2>4. AWS Integration</h2>

<h3>4.1 Database Configuration</h3>
<p>
    Setting up RDS for Laravel:
</p>
<ol>
    <li>
        <strong>Create an RDS Instance:</strong>
        <br>
        Log in to the AWS Management Console.
        <br>
        Navigate to Amazon RDS and create a new database instance.
        <br>
        Configure the instance details, including database engine, credentials, and security group settings.
    </li>
    <li>
        <strong>Database Configuration in Laravel:</strong>
        <br>
        Update Laravel's database configuration (usually found in the .env file) with RDS connection details.
    </li>
</ol>
<pre>
<code>
DB_CONNECTION=aws
DB_HOST=ims-app.c0oaeoxlqvyj.us-east-2.rds.amazonaws.com
DB_PORT=3306
DB_DATABASE=ims-app
DB_USERNAME=admin
DB_PASSWORD=it482imsapp
</code>
</pre>

<h3>4.2 Storage and Security</h3>
<p>
    AWS S3 for Storage:
</p>
<ol>
    <li>
        <strong>Create an S3 Bucket:</strong>
        <br>
        In the AWS Management Console, navigate to Amazon S3 and create a new bucket.
        <br>
        Configure bucket settings, including region and access control.
    </li>
    <li>
        <strong>Laravel Configuration for S3:</strong>
        <br>
        Update Laravel's filesystem configuration (config/filesystems.php) to use the S3 driver.
    </li>
</ol>
<pre>
<code>
php

'disks' => [
    's3' => [
        'driver' => 's3',
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION'),
        'bucket' => env('AWS_BUCKET'),
        'url' => env('AWS_URL'),
        'endpoint' => env('AWS_ENDPOINT'),
        'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        'throw' => false,
    ],
],
</code>
</pre>

<p>
    <strong>Security with IAM Roles:</strong>
</p>
<ol>
    <li>
        Create an IAM role with the necessary permissions for accessing RDS and S3.
    </li>
    <li>
        Attach the IAM role to the EC2 instance running Laravel for secure access.
    </li>
</ol>

<h2>5. Troubleshooting</h2>

<h3>5.1 Backend Issues (Laravel)</h3>
<p>
    Error Logs:
</p>
<ul>
    <li>
        <strong>Location:</strong>
        <br>
        Laravel logs errors to the storage/logs directory.
    </li>
    <li>
        <strong>Access:</strong>
        <br>
        Check for error messages in the laravel.log file.
    </li>
    <li>
        <strong>Tail the logs in real-time:</strong>
        <br>
        <code>tail -f storage/logs/laravel.log</code>
    </li>
</ul>
<p>
    Common Issues:
</p>
<ul>
    <li>
        <strong>Database connection errors:</strong>
        <br>
        Verify credentials in the .env file.
    </li>
    <li>
        <strong>Incorrect configuration:</strong>
        <br>
        Double-check environment variables.
    </li>
</ul>

<h3>5.2 Frontend Issues (Angular)</h3>
<p>
    Browser Console:
</p>
<ul>
    <li>
        <strong>Access:</strong>
        <br>
        Open the browser's developer tools (usually by pressing F12).
        <br>
        Navigate to the "Console" tab.
    </li>
</ul>
<p>
    Common Issues:
</p>
<ul>
    <li>
        <strong>Missing assets:</strong>
        <br>
        Ensure correct paths in Angular configuration.
    </li>
    <li>
        <strong>Network errors:</strong>
        <br>
        Check API requests for errors.
    </li>
    <li>
        <strong>Syntax errors:</strong>
        <br>
        Review JavaScript errors in the console.
    </li>
</ul>

<h3>5.3 AWS Services</h3>
<p>
    CloudWatch:
</p>
<ul>
    <li>
        <strong>Logs:</strong>
        <br>
        Check AWS CloudWatch logs for Lambda functions, if applicable.
    </li>
</ul>
<p>
    RDS and S3:
</p>
<ul>
    <li>
        <strong>AWS Console:</strong>
        <br>
        Review RDS and S3 dashboards for any reported issues.
    </li>
    <li>
        <strong>Security Groups:</strong>
        <br>
        Confirm that security groups allow necessary traffic.
    </li>
</ul>

<h2>6. A Message from the Developers</h2>
<p>
    This documentation provides a comprehensive guide for users and administrators of the Laravel-based Angular web application for inventory management for first responders. For further assistance, refer to the troubleshooting section or contact the development team. The Laravel-based Angular web application for inventory management represents a significant advancement in the operational capabilities of first responders. By combining the strengths of Laravel, Angular, and AWS services, the system provides a reliable and scalable solution for addressing the unique challenges faced in managing critical resources. We extend our gratitude to the developers, administrators, and first responders who contribute to the success of this system. As the needs of the users evolve, this application stands ready to adapt and support those on the front lines, ensuring they have the resources necessary to carry out their vital missions. Thank you for choosing IMS-App Inventory Management System, and we remain committed to supporting and enhancing this application for the benefit of first responders worldwide.
</p>
</body>
</html>
