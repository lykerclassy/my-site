import app from './app';
import { config } from './config';

const server = app.listen(config.port, () => {
  console.log(`API listening on http://localhost:${config.port}`);
});

process.on('SIGINT', () => server.close());
process.on('SIGTERM', () => server.close());