# AI21 Laravel Prompt

## Description
This project demonstrates the integration of AI21's API with a Laravel 11 application. The application allows users to input prompts and receive AI-generated responses using the AI21 model. The project includes user authentication and a simple chat-like interface to interact with the AI21 model.

## Installation Process

### Step 1: Clone the Repository
Clone this repository to your local machine:
```sh
git clone https://github.com/Meklad/ai21-demo.git
```

## Step 2: Navigate to the Project Directory
Change directory to the project folder:
```sh
cd ai21-demo
```

## Step 3: Copy Environment Configuration
Copy the .env.example file to .env:
```sh
cp .env.example .env
```

## Step 4: Configure Database Connection
Update your .env file with your database connection details (e.g., SQLite or MySQL).

## Step 5: Install Node.js Dependencies
Install the required Node.js dependencies:
```sh
npm install
```

## Step 6: Compile the Frontend Assets
Compile the frontend assets using Vite:
```sh
npm run dev
```

## Step 7: Run Migrations and Seed the Database
Run the database migrations and seed the database:
```sh
php artisan migrate --seed
```

## Step 8: Set AI21 API Key
Add your AI21 API key to the .env file under the key name AI21_API_KEY:
```sh
AI21_API_KEY=your_api_key_here
```

## Step 9: Serve the Application
Start the Laravel development server:
```sh
php artisan serve
```
Visit http://localhost:8000/login in your browser and log in with the following credentials:
> * Email: master@ai21-demo.io
> * Password: password

## Contact Information

If you have any questions or need further assistance, please feel free to contact me:
> * Name: Ahmed Meklad
> * Job: Backend Engineer
> * Email: ahmed.meklad.news@gmail.com
> * LinkedIn: https://linkedin.com/in/ahmed-meklad
