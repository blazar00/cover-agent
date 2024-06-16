# Use Ubuntu 22.04 as base image
FROM ubuntu:22.04

# Install curl and other dependencies
RUN apt-get update && apt-get install -y curl software-properties-common

# Install Node.js 17
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Verify that Node.js and npm were installed correctly
RUN node -v
RUN npm -v

# Set the working directory in the container to /app
WORKDIR /app
COPY . ./

# Install any needed packages specified in package.json
RUN npm install
RUN npm run test:coverage

# Run a command that never exits
CMD ["tail", "-f", "/dev/null"]