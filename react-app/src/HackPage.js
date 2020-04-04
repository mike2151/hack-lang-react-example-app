import React from 'react';
import Greeting from './Greeting.js'
import JsxParser from 'react-jsx-parser'

// class adapted from https://reactjs.org/docs/faq-ajax.html
class HackPage extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      error: null,
      isLoaded: false,
      payload: ''
    };
  }

  //
  // parser code
  //

  // helper methods for replacing react divs with actual react code
  allIndexOf(str, toSearch) {
    var indices = [];
    for(var pos = str.indexOf(toSearch); pos !== -1; pos = str.indexOf(toSearch, pos + 1)) {
        indices.push(pos);
    }
    return indices;
  }

  extractTypeFromStr(div_string) {
    let starting_idx = div_string.indexOf('data-componentType=') + 20;
    let ending_idx = div_string.indexOf('"', starting_idx);
    return div_string.substring(starting_idx, ending_idx);
  }

  // returns json of props
  extractPropsFromStr(div_string) {
    let starting_idx = div_string.indexOf('data-componentProps=') + 21;
    let ending_idx = div_string.indexOf('"', starting_idx);
    let string_json = div_string.substring(starting_idx, ending_idx);
    string_json = string_json.replace(/&amp;quot/g, '"');
    return JSON.parse(string_json);
  }

  constructComponentFromTypeAndProps(type, props) {
    let comp = "<" + type + " ";
    Object.keys(props).forEach(function(key) {
      let val = props[key];
      if (typeof val === 'string') {
        val = '"' + val + '"';
      }
      comp = comp + key + "=" + val + " ";
    });
    return comp + "/>"
  }

  remove(string, from, to) {
    return string.substring(0, from) + string.substring(to);
  }

  insert_at(original, index, string)
  {
    return original.substr(0, index) + string + original.substr(index);
  }

  processXHP(XHP) {
    // replace each div with React code
    let ctx = this;
    let div_indexes = this.allIndexOf(XHP, "<div");
    div_indexes.forEach(function(starting_div_index) {
      let ending_div_index = XHP.indexOf("</div>", starting_div_index) + 6;
      let div_substring = XHP.substring(starting_div_index, ending_div_index);
      let component_type = ctx.extractTypeFromStr(div_substring);
      let component_props = ctx.extractPropsFromStr(div_substring);
      let component_str = ctx.constructComponentFromTypeAndProps(component_type, component_props);
      XHP = ctx.remove(XHP, starting_div_index, ending_div_index);
      XHP = ctx.insert_at(XHP, starting_div_index, component_str);
    });
    return XHP;
  }

  //
  // end parser code
  //

  componentDidMount() {
    fetch(this.props.url)
      .then(res => res.text())
      .then(
        (result) => {
          result = this.processXHP(result);
          this.setState({
            isLoaded: true,
            payload: result
          });
        },
        (error) => {
          this.setState({
            isLoaded: true,
            error
          });
        }
      )
  }

  render() {
    if (this.state.isLoaded) {
      return <JsxParser
        bindings={{}}
        components={{ Greeting }}
        jsx={this.state.payload}
      />;
    } else {
      return <div></div>;
    }
  }
}

export default HackPage
