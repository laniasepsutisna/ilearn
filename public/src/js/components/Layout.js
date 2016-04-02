import React from 'react';
import Header from './Header';

export default class Layout extends React.Component {
	render() {
		const contentStyle = {
			marginTop: "60px"
		};
		return (
			<div>
				<Header />
				<div className="container" style={contentStyle}>
					<div className="row">
						<div className="col-sm-12">
							{this.props.children}
						</div>
					</div>
				</div>
			</div>
		);
	}
}