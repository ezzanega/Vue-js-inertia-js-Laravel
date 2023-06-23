#!/bin/bash
set -e

echo "Installing Node.js version $NODE_VERSION"

curl -sL https://deb.nodesource.com/setup_$NODE_VERSION.x | sudo -E bash -
sudo apt-get install -y nodejs

echo "Node.js version $NODE_VERSION installed successfully"
