# Kenya Multitenant Post System

A minimal multitenant posts API for shops in Kenya. Tenants (shops) own users and posts. Requests are scoped by tenant via the `X-Tenant-Id` header (or `?tenant=` for public reads).

## Stack
- Node.js + TypeScript + Express
- Prisma + PostgreSQL
- JWT authentication
- Zod validation

## Quick start

1. Copy env and start Postgres
```bash
cp .env.example .env
docker compose up -d
```

2. Install deps and generate Prisma client
```bash
npm install
npm run db:generate
```

3. Push schema to DB
```bash
npm run db:push
```

4. Run the API
```bash
npm run dev
```

The API listens on `http://localhost:3000`.

## API

- POST `/api/tenants` create tenant/shop
  - body: `{ name, slug, contactPhone, county?, town? }`
- GET `/api/tenants/:id` fetch tenant
- GET `/api/tenants/by-slug/:slug` fetch tenant by slug

- POST `/api/auth/register` register user in tenant
  - body: `{ tenantId, name, email, password }`
- POST `/api/auth/login` login and get JWT
  - body: `{ tenantId, email, password }`

- GET `/api/posts` list posts
  - headers: `X-Tenant-Id: <tenantId>` (or `?tenant=`). Unauthed only sees published + public posts.
  - query: `page`, `pageSize`, `search`, `tags` (comma), `category`, `status`, `visibility`
- GET `/api/posts/:id` fetch post by id
- POST `/api/posts` create post (auth required)
  - headers: `Authorization: Bearer <token>`, `X-Tenant-Id: <tenantId>`
  - body: `{ title, content, priceKES?, images?, tags?, category?, visibility?, status?, location?, contactPhone?, publishedAt? }`
- PUT `/api/posts/:id` update post (auth required)
- DELETE `/api/posts/:id` (auth required)

Notes:
- Phone numbers validated for Kenya: `+2547XXXXXXXX`, `07XXXXXXXXX`, `01XXXXXXXXX`.
- Prices are stored as integer Kenyan shillings in `priceKES`.