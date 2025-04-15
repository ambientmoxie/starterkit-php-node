import { defineConfig } from "vite";
import dotenv from "dotenv";
import fullReload from "vite-plugin-full-reload";

dotenv.config();

const isDev = process.env.VITE_ENV_MODE === "dev";
const isHost = process.env.VITE_ENV_MODE === "host";

export default defineConfig({
  root: ".",
  base: isDev || isHost ? "" : "/assets/bundle",
  server: {
    host: isHost ? true : "localhost",
    origin: isHost
      ? `http://${process.env.VITE_LOCAL_IP}:3000`
      : "http://localhost:3000",
    port: 3000,
    hot: true,
  },
  plugins: [fullReload(["**/*.php"])],
  build: {
    rollupOptions: {
      input: "./src/js/main.js",
      output: {
        entryFileNames: "[name]-[hash].js",
        assetFileNames: "[name]-[hash][extname]",
      },
    },
    manifest: true,
    outDir: "./build/bundle",
    emptyOutDir: true,
  },
});
