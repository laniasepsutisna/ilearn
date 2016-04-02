import React from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, IndexRoute, browserHistory } from 'react-router'

import Layout from './components/Layout';
import Home from './components/pages/Home';
import Notifications from './components/pages/Notifications';

import NotFound from './components/NotFound';

const app = document.getElementById('app');

ReactDOM.render(
	<Router history={ browserHistory }>
		<Route path="/" component={ Layout }>
			<IndexRoute component={ Home }></IndexRoute>
			<Route path="home" component={ Home }></Route>
			<Route path="notifications" component={ Notifications }></Route>
		</Route>
		<Route path="*" component={ NotFound }/>
	</Router>, 
app);