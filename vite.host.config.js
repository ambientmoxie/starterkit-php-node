import { defineConfig } from "vite";
import dotenv from "dotenv";

dotenv.config();

export default defineConfig({
  root: ".",
  server: {
    host: true,
    origin: `http://${process.env.VITE_DEV}:3000`,
    port: 3000,
    hot: true,
  },
});
