#!/bin/bash
set -e

echo "Setting up development environment..."

# Basic tools
apt-get update
apt-get install -y curl ca-certificates git wget

# Install GitHub CLI
mkdir -p -m 755 /etc/apt/keyrings
wget -qO- https://cli.github.com/packages/githubcli-archive-keyring.gpg | tee /etc/apt/keyrings/githubcli-archive-keyring.gpg > /dev/null
chmod go+r /etc/apt/keyrings/githubcli-archive-keyring.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/githubcli-archive-keyring.gpg] https://cli.github.com/packages stable main" | tee /etc/apt/sources.list.d/github-cli.list > /dev/null
apt-get update
apt-get install -y gh

# Install Claude CLI
curl -fsSL https://claude.ai/install.sh | bash

# Update PATH
echo 'export PATH="$HOME/.local/bin:$PATH"' >> ~/.bashrc

echo "Setup complete!"