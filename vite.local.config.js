import { defineConfig } from "vite";
import fullReload from "vite-plugin-full-reload";
import dotenv from "dotenv";

dotenv.config();

export default defineConfig({
  root: ".",
  plugins: [
    fullReload(['**/*.php']),
  ],
  server: {
    host: "localhost",
    origin: "http://localhost:3000",
    port: 3000,
    hot: true,
  },
});
