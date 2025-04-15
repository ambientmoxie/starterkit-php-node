import { defineConfig } from "vite";
import dotenv from "dotenv";

dotenv.config();

export default defineConfig({
  root: ".",
  server: {
    host: "localhost",
    origin: "http://localhost:3000",
    port: 3000,
    hot: true,
  },
});
