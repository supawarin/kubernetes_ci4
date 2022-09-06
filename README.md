# CodeIgniter 4 Application run on kubernetes
![codeigniter4-what-news](https://user-images.githubusercontent.com/83863431/188619272-dbb2f98f-bf29-4c9f-83c1-43964eef2b72.jpeg)



### 1. Create folder for new project name kubernetes_ci4 

### 2. Open project on vscode and  open terminal

### 3. Run command to install codeigniter 4 use composer below :
   
   composer create-project codeigniter4/appstarter codeigniter4
   
   
   The command above will create a “codeigniter4” folder.
   
   <img width="280" alt="c1" src="https://user-images.githubusercontent.com/83863431/188599297-c6865513-96fc-4f12-987a-de5fd0dce6f0.png">

### 4. Rename `env` to `.env`

   chang CI_ENVIRONMENT = "production"  to CI_ENVIRONMENT = "production"
   and tailor for your app, specifically the baseURL
   and any database settings.
   
### 5. Go to app-> Config-> Boot-> development.php -> chang   ini_set('display_errors', '0'); to ini_set('display_errors', '1');

   <img width="331" alt="c3" src="https://user-images.githubusercontent.com/83863431/188605711-834ea082-a1c0-4a54-a59e-4118881b2ccb.png">

### 6. Go to vender-> codeigniter4-> app-> system-> CodeIgniter.php , on line 181 type // before Locale::setDefault($this->config->defaultLocale ?? 'en');

   <img width="671" alt="c4" src="https://user-images.githubusercontent.com/83863431/188608613-80edb0d4-6053-4637-bdf9-b389b923d67e.png">

### 7. Create vhost.conf file below:

   <img width="572" alt="c2" src="https://user-images.githubusercontent.com/83863431/188599472-da022ccd-4b0b-4824-86b7-e13a766832b9.png">

### 8.  Create Dockerfile below:
   
   <img width="647" alt="c5" src="https://user-images.githubusercontent.com/83863431/188608959-8de81a97-7183-4ded-98ac-c992483ee7ba.png">

### 9. Run command : docker build . -t ci4-kubernetes  ( your images name )

### 10. Create kube Folder 
   inside kube folder have 4 file  below:
#### 10.1 Create ci4-secret.yaml
   
   <img width="812" alt="c6" src="https://user-images.githubusercontent.com/83863431/188610819-fdf1b7db-380c-4148-82a1-cae8f492a9b3.png">
   
   cd kube , and run command : 
   
   kubectl apply -f ci4-secret.yaml
   
#### 10.2 Create ci4-mysql.yaml  ( pvc + service + deployment ) 

   <img width="422" alt="c8" src="https://user-images.githubusercontent.com/83863431/188613380-66fdf494-53fc-4a09-93f6-ff07a3b148d2.png">
   <img width="706" alt="c9" src="https://user-images.githubusercontent.com/83863431/188613820-a5e6a7e1-f1d7-4708-8e34-1fd8f8fdfd7a.png">
   <img width="365" alt="c10" src="https://user-images.githubusercontent.com/83863431/188614098-5fee18f8-1903-4435-bcdf-4fef401fb0e5.png">

   kubectl apply -f ci4-mysql.yaml

#### 10.3 Create ci4-phpmyadmin.yaml  ( service + deployment )

   <img width="606" alt="c11" src="https://user-images.githubusercontent.com/83863431/188617798-e34f9ee4-d0ce-40be-8a74-49dfb894b867.png">
   <img width="644" alt="c12" src="https://user-images.githubusercontent.com/83863431/188618119-b6e04bd1-0588-4499-a8cb-94bee69fb589.png">

   kubectl apply -f ci4-phpmyadmin.yaml
   
#### 10.4 Create php.yaml  ( deployment + service )

  <img width="710" alt="c7" src="https://user-images.githubusercontent.com/83863431/188612303-20eb389d-bc2a-49c6-aa4e-f9e166d7dc07.png">

  kubectl apply -f php.yaml 
  
  - check pod are running 
  
  kubectl get pods 
  
  - check service running

  kubectl get svc
  
  <img width="739" alt="c13" src="https://user-images.githubusercontent.com/83863431/188622024-73ea4e69-85ea-4131-803b-ff4d0433dd52.png">

  And  go to http://localhost:30070  ( codeigniter 4 page )
  
  <img width="1252" alt="c14" src="https://user-images.githubusercontent.com/83863431/188622333-71c7eea7-ec99-47c6-9634-8f46ffd536de.png">
  
   and go to http://localhost:30090  ( phpmyadmin page )

  <img width="633" alt="c15" src="https://user-images.githubusercontent.com/83863431/188622885-e0afa28f-c720-42a8-ab14-514f61ee48a7.png">

  

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
