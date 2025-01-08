# Dev.to Content Management System

## Project Context

Dev.to aims to develop a comprehensive content management system (CMS) to enable developers to share articles, explore relevant content, and collaborate effectively. This system will include:

- A seamless user experience on the front office for content discovery.
- A powerful dashboard for administrators to manage users, categories, tags, and articles with ease.

The primary objective is to create a collaborative platform where developers and tech enthusiasts can register, write, and share articles while enjoying optimized navigation to discover quality content.

---

## Required Technologies

- **Language**: PHP 8 (Object-Oriented Programming).
- **Database**: PDO for database interactions.

---

## Key Features

### Back Office (Administrators)

#### Category Management:
- Create, edit, and delete categories.
- Associate multiple articles with a category.
- Visualize category statistics through charts.

#### Tag Management:
- Create, edit, and delete tags.
- Associate tags with articles for precise searches.
- Visualize tag statistics using charts.

#### User Management:
- View and manage user profiles.
- Assign permissions to users to become authors.
- Suspend or delete users for rule violations.

#### Article Management:
- Review, approve, or reject submitted articles.
- Archive inappropriate articles.
- View the most-read articles.

#### Statistics and Dashboard:
- Detailed view of entities: users, articles, categories, tags.
- Display the top 3 authors (based on published or read articles).
- Interactive charts for categories and tags.
- Overview of the most popular articles.

#### Detail Pages:
- **Single Article Page**: Complete details of an article.
- **Single Profile Page**: User profile overview.

---

### Front Office (Users)

#### Registration and Login:
- Create an account with basic information (name, email, password).
- Secure login with role-based redirection (admin to the dashboard, user to the homepage).

#### Navigation and Search:
- Interactive search bar to find articles, categories, or tags.
- Dynamic navigation between articles and categories.

#### Content Display:
- Latest articles showcased on the homepage or a dedicated section.
- Recently added or updated categories for quick discovery.
- Redirect to a unique article page displaying its content, associated categories and tags, and author details.

#### Author Space:
- Create, edit, and delete articles.
- Associate one category and multiple tags with an article.
- Manage published articles via a personal dashboard.

---

## Contribution

We welcome contributions to enhance this project. Feel free to fork the repository, make changes, and submit a pull request.

---

## License

This project is open-source and available under the MIT License.

---

## Contact

For questions or feedback, please reach out to the Dev.to team.
