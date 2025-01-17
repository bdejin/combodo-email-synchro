<?php
/**
 * Localized data
 *
 * @copyright Copyright (C) 2010-2018 Combodo SARL
 * @license	http://opensource.org/licenses/AGPL-3.0
 *
 * This file is part of iTop.
 *
 * iTop is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * iTop is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with iTop. If not, see <http://www.gnu.org/licenses/>
 */
Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	// Dictionary entries go here
	'Class:MailInboxBase' => '邮箱收件箱',
	'Class:MailInboxBase+' => '邮箱收取源',
	'Class:MailInboxBase/Attribute:server' => '邮箱服务器',
	'Class:MailInboxBase/Attribute:server+' => '邮箱服务器的IP地址或者全名',
	'Class:MailInboxBase/Attribute:mailbox' => '邮箱 (给IMAP)',
	'Class:MailInboxBase/Attribute:mailbox+' => '扫描收取邮件的IMAP邮箱 (目录). 若省略则扫描默认 (根目录) 邮箱',
	'Class:MailInboxBase/Attribute:login' => '登录账号',
	'Class:MailInboxBase/Attribute:login+' => '连接此邮箱的登陆账号',
	'Class:MailInboxBase/Attribute:password' => '密码',
	'Class:MailInboxBase/Attribute:protocol' => '协议',
	'Class:MailInboxBase/Attribute:protocol+' => '警告, 自iTop 3.1开始POP3不再保证能正常工作',
	'Class:MailInboxBase/Attribute:protocol/Value:pop3' => 'POP3',
	'Class:MailInboxBase/Attribute:protocol/Value:imap' => 'IMAP',
	'Class:MailInboxBase/Attribute:port' => '端口',
	'Class:MailInboxBase/Attribute:port+' => '143 (加密的: 993) 用于IMAP, 110 (加密的: 995) 用于POP3',
	'Class:MailInboxBase/Attribute:active' => '启用的',
	'Class:MailInboxBase/Attribute:active+' => '如果设置为 "是", 则邮箱将被读取. 否则将不被读取',
	'Class:MailInboxBase/Attribute:active/Value:yes' => '是',
	'Class:MailInboxBase/Attribute:active/Value:no' => '否',
	'MailInbox:MailboxContent' => 'Mailbox Content~~',
	'MailInbox:MailboxContent:ConfirmMessage' => '确定吗?',
	'MailInbox:EmptyMailbox' => '没有可显示的信息',
	'MailInbox:Z_DisplayedThereAre_X_Msg_Y_NewInTheMailbox' => '%1$d封邮件已显示. 一共有%2$d封邮件在邮箱中 : %3$d封新的 (包括%4$d封无法读取的), %5$d封已处理.',
	'MailInbox:MaxAllowedPacketTooSmall' => '在"my.ini"中的MySQL参数max_allowed_packet值太小: %1$s. 推荐最小值应为: %2$s',
	'MailInbox:Status' => '状态',
	'MailInbox:Subject' => '主题',
	'MailInbox:From' => '发件人',
	'MailInbox:Date' => '日期',
	'MailInbox:RelatedTicket' => '相关工单',
	'MailInbox:ErrorMessage' => '错误信息',
	'MailInbox:Status/Processed' => '已处理',
	'MailInbox:Status/New' => '新的',
	'MailInbox:Status/Error' => '错误',
	'MailInbox:Status/Undesired' => '不需要的',
	'MailInbox:Status/Ignored' => '已忽略',
	'MailInbox:Login/ServerMustBeUnique' => '此登录账号 (%1$s) 和邮箱服务器 (%2$s) 已经配置给另一个邮箱收件箱.',
	'MailInbox:Login/Server/MailboxMustBeUnique' => '此登录账号 (%1$s), 邮箱服务器 (%2$s) 和收件箱 (%3$s) 已经配置给另一个邮箱收件箱',
	'MailInbox:Display_X_eMailsStartingFrom_Y' => '显示%1$s封邮件, 开始于%2$s.',
	'MailInbox:WithSelectedDo' => '将已选择的邮件:',
	'MailInbox:ResetStatus' => '重置状态',
	'MailInbox:DeleteMessage' => '删除邮件',
	'MailInbox:IgnoreMessage' => '忽略邮件',
	'MailInbox:MessageDetails' => '邮件详情',
	'MailInbox:DownloadEml' => '下载为eml文件',
	'Class:TriggerOnMailUpdate' => '触发器 (当被邮件更新时)',
	'Class:TriggerOnMailUpdate+' => '触发器触发于工单被处理收取邮件的更新时',
));
