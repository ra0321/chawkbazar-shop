import Document, {
	Html,
	Head,
	Main,
	NextScript,
	DocumentContext,
} from "next/document";
import { i18n } from "next-i18next";
import { getDirection } from "@utils/get-direction";

export default class CustomDocument extends Document {
	static async getInitialProps(ctx: DocumentContext) {
		return await Document.getInitialProps(ctx);
	}
	render() {
		const { locale } = this.props.__NEXT_DATA__;
		if (process.env.NODE_ENV !== "production") {
			i18n?.reloadResources(locale);
		}
		return (
      <Html dir={getDirection(locale)}>
        <Head />
        <body>
        <Main />
        <NextScript />
        </body>
      </Html>
		);
	}
}
