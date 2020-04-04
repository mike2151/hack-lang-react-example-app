
class :react-component extends :x:element {
    protected function render() : XHPRoot {
        return <div data-componentType={$this->:componentType} data-componentProps={$this->:componentProps}></div>;
    }
}
