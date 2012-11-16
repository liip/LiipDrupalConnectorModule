#LiipDrupalConnectorModule

    **ATTENTION**:
    This repository is currently under heavy development and seen as pre-alpha. Do not expect
    things to stay like they are now nor that we care about BC breaks until we have a state we
    are satisfied with.


##Purpose
Doing quite a number of Drupal projects we found out that for our developers the procedural nature
of Drupal is always an obstacle. Furthermore as they are used to at least unit test their code,
they always complain about the tight coupling and 'invisible' dependencies you have to agree on
when using the Drupal functions, we had to come up with some kind on an abstraction layer to
instantiate a dedicated border between our and the Drupal world - the _LiipDrupalConnectorModule_ was
born.

##Obtain sources

### Get it from packagist.org

    **NOTE:**
    Sure there is a composer configuration file, but this module is not registered in
    packagist.org at the moment. Since the current state is really not usable, I prefer
    the module not to be registered yet. I will take care of this when the time is ready,
    I promise.

To obtain the sources via composer, execute the following commands on the command line:

```bash
$> curl -s http://getcomposer.org/installer | php
$> php composer.phar install --dev
```

### Get it from github

    **NOTE:**
    Please do not fork it unless you have the ability to maintain private repositories in your
    account. If not you probably will expose this repository before it is intended to be. If you
    want to participate in the development of this module, please sent PRs on branches. In this way
    we are still able to maintain a clean master.

If you consider participating and contribute to the connector the best way to start is by forking the repository.
For further information how to start contributing and how things are done please refer to [[Participate and contribute]].

## Getting started
TBD.
