Installation
============

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require maciejkosiarski/monolog-factory-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require maciejkosiarski/monolog-factory-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
<?php
// config/bundles.php

return [
    // ...
    MaciejKosiarski\MonologFactoryBundle\MonologFactoryBundle::class => ['all' => true],
    // ...
];

```

In Controller:

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstarctController;

class AppController extends AbstarctController
{
    public function index(LoggerFactory $logger)
    {
        $this->logger = $logger->getLogger('your_channel');
    }
    
    // ...
    
}
```

In Command:

```php
<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MaciejKosiarski\MonologFactoryBundle\Service\LoggerFactory;

class AppCommand extends Command
{
    private $Logger;
	
    public function __construct(LoggerFactory $logger)
    {
        parent::__construct();

        $this->logger = $logger->getLogger('your_channel');
    }
    
    protected function configure()
    {
    	// ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$this->logger->info('Process started', []);
    	// ...
    }
    
    // ...

}
```