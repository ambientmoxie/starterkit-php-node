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
    host: true,
    origin: `http://${process.env.VITE_DEV}:3000`,
    port: 3000,
    hot: true,
  },
});
