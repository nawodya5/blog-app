🌍 Laravel Deployment on AWS using Terraform & CodePipeline

This project explains how I deployed a Laravel application to AWS EC2 using Terraform, GitHub, and AWS CodePipeline, following production-ready best practices.

Repository: blog-app

🧩 Step 1: Version Control Setup

I started by keeping all my project files in GitHub.
Using Git helps track changes, work with branches, and collaborate easily.

Commands used:

    Windows PowerShell
    
    git init
    git add .
    git commit -m "Initial commit"
    git branch -M main
    git remote add origin https://github.com/nawodya5/blog-app.git
    git push -u origin main


Linux

    git init
    git add .
    git commit -m "Initial commit"
    git branch -M main
    git remote add origin https://github.com/nawodya5/blog-app.git
    git push -u origin main


Tip:
Keep your .env, /vendor, /node_modules, .terraform, and other big folders inside .gitignore.
This prevents large files from being uploaded and rejected by GitHub.

⚙️ Step 2: Define Infrastructure with Terraform

I didn’t manually create AWS resources. Instead, I used Terraform to build everything.

Terraform created:

An EC2 instance (Ubuntu 22.04)

A Security Group for ports 22 (SSH) and 80 (HTTP)

An RDS MySQL 8 database

An S3 bucket for storing artifacts (optional)

Networking rules (CIDR blocks)

Terraform commands:

    terraform init
    terraform plan
    terraform apply


Once applied, Terraform automatically created the environment on AWS.

Example of CIDR block usage:

    0.0.0.0/0


This means the port is open to all IP addresses.
For production, you should allow only your IP (for example 123.45.67.89/32) in SSH (port 22) to increase security.

🔐 Step 3: Security Groups & Access Control

Security groups act like a firewall around your EC2 instance.

For this project:

    Port 22 → open for SSH access (only my IP)
    
    Port 80 → open for HTTP (so everyone can view the website)

Example rule:

Type	Protocol	Port Range	Source
SSH	    TCP	            22	    My IP only
HTTP	TCP	            80	    0.0.0.0/0
💻 Step 4: Connect to EC2 Instance

After Terraform created the EC2, I connected to it.

PowerShell (Windows):

    ssh -i "my-key.pem" ubuntu@ec2-13-221-85-17.compute-1.amazonaws.com


Linux:

    chmod 400 my-key.pem
    ssh -i "my-key.pem" ubuntu@ec2-13-221-85-17.compute-1.amazonaws.com


If SSH gives “timeout” errors, check:

Security group allows port 22

Instance is in running state

You’re using the correct key pair and path

🐘 Step 5: Install Required Software

Inside EC2, I installed all necessary packages for Laravel:

    sudo apt update
    sudo apt install apache2 php libapache2-mod-php php-mysql unzip curl git composer -y


Check PHP version:

    php -v


Laravel needs PHP >= 8.2, so I upgraded:

    sudo add-apt-repository ppa:ondrej/php
    sudo apt update
    sudo apt install php8.2 php8.2-mbstring php8.2-xml php8.2-curl php8.2-mysql -y


Restart Apache:

    sudo systemctl restart apache2

🧱 Step 6: Deploy with AWS CodePipeline

After the environment was ready, I created an AWS CodePipeline that:

Takes source code from GitHub (main branch)

Builds (optional)

Deploys automatically to EC2

Since CodeDeploy is not fully free-tier, I selected EC2 directly in the “Deploy” stage instead of CodeDeploy.

This setup ensures that whenever I push code to GitHub, the pipeline detects the change and updates my EC2 application automatically.

🗄️ Step 7: Configure Database (MySQL on RDS)

I created an RDS MySQL 8 instance for the Laravel app.

After creation, I copied:

Endpoint (example: mydb.cakf38ghxyz.us-east-1.rds.amazonaws.com)

Username

Password

Database name

Then, I connected from EC2:

    mysql -h mydb.cakf38ghxyz.us-east-1.rds.amazonaws.com -u admin -p


Inside Laravel’s .env file:

    DB_CONNECTION=mysql
    DB_HOST=mydb.cakf38ghxyz.us-east-1.rds.amazonaws.com
    DB_PORT=3306
    DB_DATABASE=blog_app
    DB_USERNAME=admin
    DB_PASSWORD=yourpassword

⚡ Step 8: Run Laravel in Production

Inside the EC2 instance:
    
    cd /var/www/laravel
    composer install --optimize-autoloader --no-dev
    php artisan key:generate
    php artisan migrate --force


To serve the app:

    sudo php artisan serve --host=0.0.0.0 --port=80


If you get a “Permission denied” error on port 80:
    
    sudo setcap 'cap_net_bind_service=+ep' $(which php)


Now you can visit:
👉 http://13.221.85.17

🧰 Step 9: Troubleshooting Tips

Common Issues

Error	Cause	Fix
Connection timed out	Port 22 blocked	Allow SSH in SG
Permission denied (publickey)	Wrong key file	Use correct .pem and chmod 400
Composer detected PHP version <8.2	Old PHP	Upgrade PHP
500 Server Error	Missing .env	Upload correct .env
Large file rejected by Git	Pushed large folder (.terraform, vendor)	Add to .gitignore and re-commit
🧾 Step 10: Final Check

 Laravel runs on EC2

 RDS connected successfully

 Pipeline auto-deploys

 Security rules applied properly

 GitHub integrated correctly

🥳 Result

Laravel application is now automatically deployed to AWS EC2, connected with RDS, and managed through GitHub and CodePipeline.
The full system runs smoothly under the AWS Free Tier using infrastructure built by Terraform.

🧠 Key Takeaways

Use Infrastructure as Code (IaC) instead of manual setup

Always protect SSH and DB access

Automate deployments through CodePipeline

Keep large/unnecessary files out of Git

Use environment variables in .env for security
