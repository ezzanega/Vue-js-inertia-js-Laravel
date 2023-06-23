#!/bin/bash

# Set Node.js version
NODE_VERSION=${NODE_VERSION:-16}

# Update package list
sudo apt-get update

# Install Node.js and npm
curl -fsSL https://deb.nodesource.com/setup_$NODE_VERSION.x | sudo -E bash -
sudo apt-get install -y nodejs

# Check Node.js version
node -v
