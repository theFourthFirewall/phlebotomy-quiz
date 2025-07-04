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
- **Keep-Alive Mechanism**: Automatic server ping to prevent free-tier hibernation

## Technology Stack

- **Backend**: Laravel 11 (PHP 8.3)
- **Frontend**: Vue 3 (Composition API with `<script setup>`)
- **Styling**: Tailwind CSS
- **Build Tool**: Vite
- **Environment**: Windows 11 with WSL 2 (Ubuntu)

## Current Implementation Status

**✅ Phase 1: Backend API (Completed)**
- Laravel 11 application with API routing configured
- `/api/questions` endpoint serving 15 phlebotomy scenarios
- CORS configured via Laravel Sanctum for frontend integration
- Local testing verified - API returns proper JSON structure
- **DEPLOYED**: Live API at https://phlebotomy-quiz.onrender.com/api/questions

**✅ Phase 2: Frontend Vue SPA (Completed)**
- Vue 3 SPA with complete quiz functionality
- Tailwind CSS styling with medical theming
- Interactive quiz interface with immediate feedback
- Progress tracking and completion summary
- Responsive design for all devices

**✅ Phase 3: Frontend Deployment (Completed)**
- Frontend deployed to Netlify with environment variable configuration
- CORS configured for cross-origin requests
- **DEPLOYED**: Live application at https://dalton-orvis-phlebotomy-quiz.netlify.app

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

### Testing the API

With the Laravel server running, you can test the API endpoints:

```bash
# Test the questions endpoint
curl http://127.0.0.1:8000/api/questions

# Test the ping endpoint
curl http://127.0.0.1:8000/api/ping

# Or visit in your browser
http://127.0.0.1:8000/api/questions
http://127.0.0.1:8000/api/ping
```

The questions endpoint will return all 15 phlebotomy quiz questions in JSON format, while the ping endpoint will return a simple status response.

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

### GET /api/ping

A lightweight endpoint used for health checks and keeping the server alive. Returns a simple status response.

**Response:**
```json
{
  "status": "ok"
}
```

**Status Code:** 200 OK

This endpoint is particularly useful for:
- Health monitoring services
- Preventing server hibernation on platforms like Render
- Quick API availability checks

## Live Demo

**🌐 API Endpoints**: 
- Questions: https://phlebotomy-quiz.onrender.com/api/questions
- Health Check: https://phlebotomy-quiz.onrender.com/api/ping

The backend API is currently deployed and serving quiz questions. You can test the endpoints directly in your browser or with curl:

```bash
# Get quiz questions
curl https://phlebotomy-quiz.onrender.com/api/questions

# Check API health status
curl https://phlebotomy-quiz.onrender.com/api/ping
```

## Building for Production

### Frontend Build
```bash
npm run build
```

The built files will be in the `dist` directory, ready for deployment to Netlify.

### Backend Deployment (Completed)

The Laravel API is deployed on Render using Docker. The deployment configuration includes:

- **Platform**: Render (Docker)
- **Environment**: PHP 8.3 with Apache
- **Build Process**: Automated via Dockerfile
- **Live URL**: https://phlebotomy-quiz.onrender.com

**Environment Variables configured on Render:**
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY=[generated key]`
- `APP_URL=https://phlebotomy-quiz.onrender.com`
- `LOG_CHANNEL=stderr`
- `SESSION_DRIVER=array`
- `CACHE_STORE=array`
- `QUEUE_CONNECTION=sync`

### Frontend Preparation
1. Configure CORS in Sanctum to allow your production frontend URL
2. Set up environment variables for production
3. Deploy to your hosting provider (e.g., Render)

## Deployment Configuration

### Netlify (Frontend) - ✅ Completed
- Build Command: `npm run build -- --mode netlify`
- Publish Directory: `dist`
- Environment Variables: `VITE_API_URL=https://phlebotomy-quiz.onrender.com`
- **Live URL**: https://dalton-orvis-phlebotomy-quiz.netlify.app

### Render (Backend) - ✅ Completed
- **Deployment Method**: Docker (using included Dockerfile)
- **Auto-Deploy**: Enabled from GitHub main branch
- **Environment Variables**: Includes `SANCTUM_STATEFUL_DOMAINS` for CORS
- **Live URL**: https://phlebotomy-quiz.onrender.com

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