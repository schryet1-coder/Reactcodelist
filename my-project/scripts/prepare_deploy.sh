#!/usr/bin/env bash
set -euo pipefail

# Prepare a deployable ZIP for shared hosting where public files go to /htdocs
# Usage: ./scripts/prepare_deploy.sh ./deploy.zip

OUT=${1:-./deploy.zip}
TMPDIR=$(mktemp -d)
mkdir -p "$TMPDIR/laravel_app"
mkdir -p "$TMPDIR/htdocs"

echo "Copying application files..."
# Copy everything except the public folder into laravel_app
rsync -a --exclude='public' --exclude='.git' --exclude='node_modules' --exclude='.github' --exclude='tests' --exclude='deploy' --exclude='deploy.zip' --exclude='README_ADDITIONS.md' --exclude='*.zip' ./ "$TMPDIR/laravel_app/"

echo "Copying public/ to htdocs..."
rsync -a public/ "$TMPDIR/htdocs/"

echo "Creating ZIP $OUT"
(cd "$TMPDIR" && zip -r -X "$OUT" .)

echo "Cleaning..."
rm -rf "$TMPDIR"
echo "Done. Deploy package: $OUT"
