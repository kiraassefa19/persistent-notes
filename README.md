# Persistent Notes App

A simple single-page application built with Laravel, Vue.js, and Inertia.js that allows users to create and view persistent notes.

## Features

- View a list of previously saved notes
- Add new notes via an input field
- Real-time updates without page reload
- Persistent storage using SQLite database
- Clean and modern UI with Tailwind CSS

## Requirements

- PHP 8.1 or higher
- Node.js 18 or higher
- Composer
- SQLite

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/persistent-notes.git
cd persistent-notes
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Create the database:
```bash
touch database/database.sqlite
```

7. Run migrations:
```bash
php artisan migrate
```

## Running the Application

1. Start the Laravel development server:
```bash
php artisan serve
```

2. In a separate terminal, start the Vite development server:
```bash
npm run dev
```

3. Visit http://localhost:8000/notes in your browser

## Running Tests

1. Run PHPUnit tests:
```bash
php artisan test
```

2. Run Browser tests (requires Chrome/Chromium):
```bash
php artisan dusk
```

## CI/CD

This project uses GitHub Actions for continuous integration and deployment. The workflow:

1. Runs PHPUnit tests
2. Runs Browser tests
3. Builds the application
4. Deploys to GitHub Pages

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
