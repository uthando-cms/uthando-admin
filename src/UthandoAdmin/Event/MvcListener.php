<?php
namespace UthandoAdmin\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;

class MvcListener implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'));
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchError'));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
    
    public function renderTheme(MvcEvent $event)
    {
        $sm = $event->getApplication()->getServiceManager();
        
        $configFile = APPLICATION_PATH . '/public/themes/admin/config.php';
        $config = include ($configFile);
        
        $viewResolver = $sm->get('ViewResolver');
        $themeResolver = new \Zend\View\Resolver\AggregateResolver();
        
        if (isset($config['template_map'])){
            $viewResolverMap = $sm->get('ViewTemplateMapResolver');
            $viewResolverMap->add($config['template_map']);
            $mapResolver = new \Zend\View\Resolver\TemplateMapResolver(
                $config['template_map']
            );
            $themeResolver->attach($mapResolver);
        }
        
        $viewResolver->attach($themeResolver, 1000);
    }
    
    public function onDispatch(MvcEvent $event)
    {
        $match = $event->getRouteMatch();
        $controller = $event->getTarget();
        
        if (!$match instanceof RouteMatch || false === strpos($match->getMatchedRouteName(), 'admin')) {
            return;
        }
        
        $this->renderTheme($event);
    }
    
    public function onDispatchError(MvcEvent $event)
    {
    	$request = $event->getRequest();
    	$requestUri = $request->getRequestUri(); 
    	
        if (false === strpos($requestUri, 'admin')) {
    		return;
    	}
    	
    	$this->renderTheme($event);
    }
}
