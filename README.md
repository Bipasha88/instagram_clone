# Instagram-style Social API

A **Laravel 8 REST API** for a photo-sharing social network, secured with **Laravel Passport (OAuth2)**. The user accounts and the follow system are finished. The database schema for posts, comments, tags, reactions and images uses **polymorphic relationships**.

> 🚧 **Status:** registration, login and following/unfollowing are complete. Post, comment and reaction endpoints are the next step: their tables and models already exist.

## Features

- Register and log in with Passport access tokens
- Follow and unfollow users, and list a user's followers
- A unique `(user_id, follower_id)` constraint stops duplicate follows
- Repository pattern with interfaces, bound in a dedicated `RepositoryServiceProvider`

## API

| Method | Endpoint         | Auth   | Description            |
|--------|------------------|--------|------------------------|
| POST   | `/api/register`  | –      | Create an account      |
| POST   | `/api/login`     | –      | Get an access token    |
| GET    | `/api/user`      | Bearer | Current user           |
| POST   | `/api/follow`    | Bearer | Follow a user          |
| POST   | `/api/unfollow`  | Bearer | Unfollow a user        |
| GET    | `/api/followers` | Bearer | List followers         |

## Data model

The schema uses Eloquent **polymorphic relationships**, so tags, reactions and images can be attached to any model (posts, comments, users) without separate tables for each.

| Table                        | Purpose                                                      |
|------------------------------|--------------------------------------------------------------|
| `users`, `follows`           | Accounts and follower graph                                  |
| `posts`, `comments`          | Content                                                      |
| `tags` + `taggables`         | Polymorphic many-to-many: tag posts, comments, …             |
| `reactions` + `reactables`   | Polymorphic many-to-many: react to posts or comments         |
| `images` (`imageable`)       | Polymorphic one-to-many: attach images to any model          |
| `settings`                   | Key/value application settings                               |

## Architecture

```
app/
├── Http/Controllers/          # AuthController, UserController
├── Repository/
│   ├── Interfaces/            # EloquentRepositoryInterface, UserRepositoryInterface, FollowRepositoryInterface
│   └── Repositories/          # BaseRepository, UserRepository, FollowRepository
├── Providers/RepositoryServiceProvider.php
└── Models/                    # User, Post, Comment, Tag, Reaction, Follow, Setting, Imageable
```

## Tech stack

PHP 7.3+/8 · Laravel 8 · Laravel Passport (OAuth2) · MySQL

## Getting started

```bash
git clone https://github.com/Bipasha88/instagram_clone.git
cd instagram_clone

composer install
cp .env.example .env
php artisan key:generate
# In .env: set the DB_* values

php artisan migrate
php artisan passport:install
php artisan serve
```

## Roadmap

- [ ] Create, list and delete posts with image upload
- [ ] Comments on posts
- [ ] Reactions on posts and comments
- [ ] Hashtags and tag search
- [ ] News feed built from followed users
