import React from 'react';

import Header from './components/Header';

export default class Layout extends React.Component {
	render() {
		return (
			<div>
				<Header />
				<div className="container">
					<div className="row">
						<div className="col-sm-12">
						Hi
						</div>
					</div>
				</div>
			</div>
		);
	}
}