import { defineConfig } from "vite";
import dotenv from "dotenv";

dotenv.config();

export default defineConfig({
  root: ".",
  base: process.env.VITE_DEV == "true" ? "" : "/assets/bundle",
  build: {
    rollupOptions: {
      input: "./assets/js/main.js",
      output: {
        entryFileNames: "[name]-[hash].js",
        assetFileNames: "[name]-[hash][extname]",
      },
    },
    manifest: true,
    outDir: "./assets/bundle",
    emptyOutDir: true,
  },
});
