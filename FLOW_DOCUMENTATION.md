# JobFinder: Application Flow & Architecture

This document provides a high-level overview of how the JobFinder platform works, the user journeys, and the underlying data flow.

## 1. User Journeys (The Flow)

JobFinder serves two primary modes of interaction: **Guest (Unauthenticated)** and **Registered User (Authenticated)**.

### A. The Guest Journey (Discovery & Exploration)
Visitors to the site can explore the platform freely without creating an account. The goal of this flow is to showcase opportunities and drive sign-ups.

1. **Homepage (`/`)**: 
   - The user lands on a visually rich, 3D-animated homepage.
   - They can immediately use the primary search bar to find jobs by title, location, or category.
2. **Discovery Pages**:
   - **Find Jobs (`/jobs`)**: A comprehensive search interface with filters (Job Type, Salary, Experience). Users can browse paginated job cards.
   - **Companies (`/companies`)**: Users can discover top employers, filter by industry, and view company profiles to see all open positions for that specific company.
   - **Categories & Locations (`/categories`, `/locations`)**: Visual directories that allow users to browse jobs by specific fields or geographic hubs.
3. **Interactive Tools**:
   - **Career Explorer (`/career-explorer`)**: A gamified tool where users select a broad interest (e.g., "Technology") and the system recommends specific high-demand career paths.
   - **Smart Match (`/smart-match`)**: Users select the technical skills they possess (e.g., Laravel, PHP), and a rule-based algorithm calculates and displays exact percentage matches with active job postings.
4. **Call to Action**: 
   - If a guest attempts to click "Apply" on a job or "Save Job", they are intercepted by middleware and redirected to the Login/Register page.

### B. The Registered User Journey (Application & Management)
Once a user creates an account, the platform transforms into a personal career management dashboard.

1. **Authentication (`/login`, `/register`)**:
   - Users create an account. The platform uses Laravel's native session-based authentication.
2. **Profile Completion (`/profile`)**:
   - Upon logging in, users are encouraged to complete their profile (Bio, Education, Experience, Skills, and uploading a PDF/DOC Resume). 
   - The Dashboard calculates a "Profile Completion" percentage dynamically based on these fields.
3. **Applying for Jobs (`/jobs/{id}/apply`)**:
   - When viewing a job, authenticated users can submit an application.
   - The system checks if they have already applied to prevent duplicates.
   - The user attaches their resume and a cover letter.
4. **The Dashboard (`/dashboard`)**:
   - Serves as the central hub. Users can track the status of their applications (e.g., "Applied", "Reviewed", "Interviewing").
   - Users can view their "Saved Jobs" to apply to later.

---

## 2. Technical Architecture & Data Flow

The application follows a standard **MVC (Model-View-Controller)** pattern built on the Laravel framework.

### The Database Models
- **User**: Represents registered candidates. Stores authentication credentials and profile data.
- **Job**: Represents a job posting. Belongs to a Company.
- **Company**: Represents an employer. Has many Jobs.
- **Application**: The pivot/transactional record linking a User to a Job. Stores the cover letter and application status.
- **Category & Location**: Taxonomy models used to group jobs.
- **Skill**: Tags associated with Jobs (and potentially Users) used heavily by the Smart Match algorithm.
- **BlogPost & ContactMessage**: Models handling the static content and inbound support requests.

### The Request Lifecycle (Example: Smart Match)
1. **Frontend (View/JS)**: The user selects skills on the `/smart-match` page and clicks "Calculate". JavaScript intercepts this and sends an AJAX POST request with the selected skill IDs.
2. **Routing (`web.php`)**: The route `/smart-match/calculate` catches the POST request and routes it to the `DiscoveryController@calculateMatch`.
3. **Controller Logic**: 
   - The controller receives the array of skill IDs.
   - It queries the database using Eloquent (`Job::with('skills')->get()`) to fetch all jobs.
   - It runs a mathematical intersection between the user's skills and each job's required skills to determine a percentage.
4. **Response**: The controller returns a JSON array of the top matching jobs.
5. **Frontend Update**: JavaScript receives the JSON and dynamically injects the result cards into the DOM, triggering GSAP animations to draw the percentage rings.

### Asset & Visual Management
- **CSS System**: Custom Vanilla CSS leveraging CSS Grid/Flexbox and CSS Variables for theming. Complex layouts use media queries to collapse on mobile devices.
- **Motion Engine**: Instead of heavy WebGL, the platform uses lightweight Vanilla JS (calculating mouse coordinates relative to DOM elements) for 3D card tilts and parallax effects, alongside GSAP (`ScrollTrigger`) for scroll-based reveals and counter animations. All animations respect OS-level `prefers-reduced-motion` settings for accessibility.
- **Storage**: User-uploaded resumes are stored securely in Laravel's local storage disk, preventing public access without authorization.
