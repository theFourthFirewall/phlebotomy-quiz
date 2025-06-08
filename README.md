# Phlebotomy Situational Quiz

A modern, single-page web application designed to test situational judgment on phlebotomy topics. Built with Laravel 11, Vue 3, and Tailwind CSS, this application demonstrates proficiency in full-stack development with a decoupled architecture.

## Project Overview

This application serves as a professional micro-training tool for phlebotomy situational judgment. Users navigate through 15 scenario-based multiple-choice questions, receiving immediate feedback and explanations for each answer.

### Key Features

- **Welcome Screen**: Clean landing page with project introduction
- **Interactive Quiz Interface**: 15 situational multiple-choice questions
- **Immediate Feedback**: Visual and textual feedback for each answer
- **Progress Tracking**: Real-time progress bar and question counter
- **Completion Summary**: Final score display with option to retake
- **Fully Responsive**: Optimized for desktop and mobile devices
- **Decoupled Architecture**: Separate frontend and backend deployments

## Technology Stack

- **Backend**: Laravel 11 (PHP 8.3)
- **Frontend**: Vue 3 (Composition API with `<script setup>`)
- **Styling**: Tailwind CSS
- **Build Tool**: Vite
- **Environment**: Windows 11 with WSL 2 (Ubuntu)

## Architecture

The application follows a decoupled architecture pattern:

```
┌─────────────────────────────────┐
│   User's Browser                │
│  (Vue SPA from Netlify)         │
└─────────────────────────────────┘
             │
             │ API Requests
             ▼
┌─────────────────────────────────┐
│   Laravel API Server            │
│  (RESTful JSON API on Render)   │
└─────────────────────────────────┘
```

## Local Development Setup

### Prerequisites

- PHP 8.3+
- Composer
- Node.js 18+
- npm

### Installation

1. Clone the repository:
```bash
git clone [repository-url]
cd phlebotomy-quiz
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Copy the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run database migrations (if applicable):
```bash
php artisan migrate
```

### Running the Application

1. Start the Laravel development server:
```bash
php artisan serve
```

2. In a separate terminal, start the Vite development server:
```bash
npm run dev
```

3. Access the application at `http://localhost:8000`

## API Endpoints

### GET /api/questions

Returns an array of quiz questions with the following structure:

```json
[
  {
    "id": 1,
    "scenario": "You are preparing to draw blood from an anxious patient...",
    "question": "What is the most appropriate course of action?",
    "options": [
      { "id": "a", "text": "Proceed with the draw as normal." },
      { "id": "b", "text": "Have the patient lie down for the procedure." },
      { "id": "c", "text": "Offer the patient a glass of water." },
      { "id": "d", "text": "Ask a colleague to assist you." }
    ],
    "correctAnswerId": "b",
    "explanation": "Having a patient with a history of fainting..."
  }
]
```

## Building for Production

### Frontend Build
```bash
npm run build
```

The built files will be in the `dist` directory, ready for deployment to Netlify.

### Backend Preparation
1. Configure CORS in `config/cors.php` to allow your production frontend URL
2. Set up environment variables for production
3. Deploy to your hosting provider (e.g., Render)

## Deployment Configuration

### Netlify (Frontend)
- Build Command: `npm run build`
- Publish Directory: `dist`
- Environment Variables: `VITE_API_URL=https://your-api-url.onrender.com`

### Render (Backend)
- Build Command: `composer install`
- Start Command: `php artisan serve --host 0.0.0.0 --port $PORT`

## Project Structure

```
phlebotomy-quiz/
├── app/                    # Laravel application logic
│   └── Http/
│       └── Controllers/
│           └── Api/        # API controllers
├── resources/
│   ├── css/               # Tailwind CSS styles
│   ├── js/                # Vue application
│   │   ├── components/    # Vue components
│   │   ├── composables/   # Vue composables
│   │   └── views/         # Vue views
│   └── views/             # Blade templates
├── routes/
│   ├── api.php           # API routes
│   └── web.php           # Web routes
├── public/               # Public assets
├── config/               # Configuration files
├── database/             # Database files
├── tests/                # Test files
├── package.json          # NPM dependencies
├── composer.json         # PHP dependencies
├── vite.config.js        # Vite configuration
├── tailwind.config.js    # Tailwind configuration
└── README.md            # This file
```

## Development Workflow

1. **Feature Development**: Create feature branches from `main`
2. **Testing**: Run tests before committing
3. **Code Style**: Follow PSR-12 for PHP and Vue style guide
4. **Commits**: Use conventional commit messages
5. **Pull Requests**: Submit PRs for code review

## Testing

Run PHP tests:
```bash
php artisan test
```

Run JavaScript tests (if configured):
```bash
npm test
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).

## Acknowledgments

- Built as a demonstration project for Intelvio
- Showcases modern web development practices
- Emphasizes clean code and professional architecture