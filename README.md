# README FIRST

#### NOTE: THIS IS JUST FOR TESTING THE BUNDLE. MESSY SETUP TO PROTOTYPE AND EXPERIMENT. NOT PROPER WAY

##  Setup

Open config/services.yaml. Search the following snippet

```
    App\:
            resource: '../src/*'
            exclude: '../src/{Entity,Migrations,Tests,Kernel.php}'

```

Now next step is to exclude the Sbcamp folder in config/services.yaml

It should look like this after excluding

```
    App\:
            resource: '../src/*'
            exclude: '../src/{Sbcamp,Entity,Migrations,Tests,Kernel.php}'
            
```
