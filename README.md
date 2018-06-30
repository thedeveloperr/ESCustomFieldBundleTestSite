# README FIRST

#### NOTE: THIS IS JUST FOR TESTING THE BUNDLE. MESSY SETUP TO PROTOTYPE AND EXPERIMENT. NOT PROPER WAY

##### Windows was giving some error in setup. 

##  Setup - tested on macOS

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

Now before setup and running composer install you have to change one small things

1. open projects' main composer.json and find the following lines 

    ```
    "repositories": [
        {
          "type": "path",
          "url": "/Users/thedeveloperr/dev/sbcampv3/projects/ESCustomFieldBundleTestSite/src/Sbcamp/Bundle/CustomFieldsBundle"
        }
      ]
    
    ```
 2. The url parameter must point to the path where CustomFieldsBundle is store in your local computer. Change the url paramater according to your computer

    ```
    "repositories": [
        {
          "type": "path",
          "url": "<path where this project is cloned>/ESCustomFieldBundleTestSite/src/Sbcamp/Bundle/CustomFieldsBundle"
        }
      ]
    
    ```


After these steps run the following command from the within the project

```$xslt
composer install
```


### TODO Bundle Mohit Gupta:

- Still need to decide whether give user responsibilty of creating machine name while first creating the field
- Search : will be done by 4th July
- pagination support: will be done by 4th July
- reading configs: will be done by 2nd July
- Add Proper classes for all types of exception: Will be done by 5th July
- Give user power to control advanced query and features for elasticsearch: No date fixed as have to learn more about Elasticsearch
- Delete Custom Field - Garbage collection - Not planned yet how to do it
- delete Lead Profile 

### TODO Test site Jaskaran Rehal:
- improve frontend
- Controller for adding Lead
- Controller for updating lead 
- controller for sending search request
- Twig editing custom field
- navigation bar
- Twig templates for searching
- Controller side exception handling and showing good error messages from twig to frontend
