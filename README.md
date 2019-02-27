# FatBoard

### Why ?
---

### Requirements
---

- Apache 2.4
- PHP 7.2
- MySQL 5.7
- Composer
- Yarn
- Docker && Docker compose

### Usage
---

charger les fixtures 
```
bin/console doctrine:fixtures:load 
```

### Installation
---

```
git clone git@bitbucket.org:Jonathankablan/furiousducks.git
cd furiousducks
./install.sh
```

### Installation front-end
---

Installation des dépendances :

```
cd app/integration
yarn install
```

Production (yarn install --production && gulp --production):

```
yarn run start
```

Développement (yarn && gulp):

```
yarn run start:dev
```

Pour plus d'informations, consulter le fichier [README.md](app/integration/README.md)

### Configuration
---

### Troubleshooting
---

### FAQ
---

### Deployment
---

### Documentation
---

### Authors / Maintainers
---

- Jonathan Kablan
- Sarah
- Louis Dauvergne
