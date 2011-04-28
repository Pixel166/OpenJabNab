#ifndef _PLUGINTEST_H_
#define _PLUGINTEST_H_

#include "plugininterface.h"
	
class PluginTest : public PluginInterface
{
	Q_OBJECT
	Q_INTERFACES(PluginInterface)

public:
	PluginTest();
	virtual ~PluginTest();
	bool OnClick(Bunny *, PluginInterface::ClickType);
	bool HttpRequestHandle(HTTPRequest &);
	void InitApiCalls();
	PLUGIN_BUNNY_API_CALL(Api_LaunchTests);

private:
	int angle;
};

#endif
