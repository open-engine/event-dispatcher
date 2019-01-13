[![Latest Stable Version](https://img.shields.io/packagist/v/open-engine/event-dispatcher.svg)](https://packagist.org/packages/open-engine/event-dispatcher)
[![Code Quality](https://img.shields.io/scrutinizer/g/open-engine/event-dispatcher.svg)](https://scrutinizer-ci.com/g/open-engine/event-dispatcher)
[![Code intelligence](https://scrutinizer-ci.com/g/open-engine/event-dispatcher/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/g/open-engine/event-dispatcher)
[![License](https://img.shields.io/badge/license-GPL%203-green.svg)](https://github.com/open-engine/event-dispatcher/blob/master/LICENSE)

# Event dispatcher


## Event

Event can be any class

## Dispatch some event
```php
$dispatcher = new EventDispatcher($listenerProvier);
$event = $dispatcher->dispatch(new FooEvent());
```

## Add listener to some event

```php
$config = new ListenerProviderConfig();

$config->addListener(FooEvent::class, function (FooEvent $event) {
    // do somthing
    return $event;
}, 20);

$config->addListener(FooEvent::class, '\Acme\listeners\AnotherListener::methodName');

// add another listeners 

$listenerProvider = new ListenerProvider($config);

```

Add listener method parameters:
* $eventClass <code>string</code> - Event name. It always equals to event class name
* $listener <code>callable</code> - Listener is any callabe wich have only one paramater $event. Listener must return same $event
* $priority <code>int</code> - Optiona. Default is 1000. Zero is highest priority

