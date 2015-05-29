<?php

namespace spec\Ezynda3\FeatureToggle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Ezynda3\FeatureToggle\Manager');
    }

    function it_loads_a_feature_variable()
    {
        putenv('FEATURE_FOOBAR=true');
        $this->feature('FOOBAR')->shouldReturn($this);
    }

    function it_informs_if_a_feature_is_enabled()
    {
        // Enabled is true
        putenv('FEATURE_FOOBAR=true');
        $this->feature('FOOBAR')->isEnabled()->shouldReturn(true);

        // Enabled is false
        putenv('FEATURE_FOOBAR=false');
        $this->feature('FOOBAR')->isEnabled()->shouldReturn(false);

        // Feature is not defied
        putenv('FEATURE_FOOBAR');
        $this->feature('FOOBAR')->isEnabled()->shouldReturn(false);
    }

    function it_throws_an_exception_if_a_feature_is_not_selected_first()
    {
        $this->shouldThrow('\BadMethodCallException')->during('isEnabled');
    }

    function it_converts_feature_names_to_all_caps()
    {
        putenv('FEATURE_FOOBAR=true');
        $this->feature('foobar')->isEnabled()->shouldReturn(true);
    }
}
