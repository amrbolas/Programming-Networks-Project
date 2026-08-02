# Containerized Deployment of Scoold Q&A Platform

## Student Information

- **Student:** Amr Bolas
- **Instructor:** Dr. Jehad Hamamreh
- **Course:** Programming Networks
- **Project Type:** Network Deployment and Systems Integration

## Project Overview

This project demonstrates the deployment of the Scoold Question and Answer platform in a self-hosted containerized environment.

The project combines application deployment, network simulation, secure public access, dynamic routing, firewall configuration, and WordPress integration.

## Main Technologies

- Proxmox VE
- Ubuntu LXC
- Docker
- Docker Compose
- Scoold
- Para
- Cloudflare Tunnel
- Containerlab
- FRRouting
- OSPF
- NAT
- iptables Firewall
- WordPress
- MariaDB
- PHP

## Project Components

### Scoold Deployment

Scoold and Para are deployed as Docker containers. Para provides the backend services required by Scoold.

### Containerlab Network

The Containerlab topology includes:

- Two client networks
- Two FRRouting routers
- OSPF dynamic routing
- ISP node
- Stateful firewall
- NAT and Internet connectivity

### WordPress Integration

A custom WordPress plugin displays Scoold statistics and the latest questions inside WordPress using the shortcode:

`[scoold_dashboard]`

## Public URLs

- **Scoold Platform:** https://app.amrbolas.site
- **WordPress Portal:** https://portal.amrbolas.site

## Repository Structure

- Containerlab/
- Scoold-Docker/
- WordPress-Plugin/
- Report/
- Presentation/
- Images/
- Commands/

## Security Notice

Real passwords, tokens, private keys, and application secrets are not included in this repository. Example configuration files use `CHANGE_ME` placeholders.
