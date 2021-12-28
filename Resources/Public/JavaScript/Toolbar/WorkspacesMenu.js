/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
var __importDefault=this&&this.__importDefault||function(e){return e&&e.__esModule?e:{default:e}};define(["require","exports","jquery","TYPO3/CMS/Core/Ajax/AjaxRequest","TYPO3/CMS/Backend/ModuleMenu","TYPO3/CMS/Backend/Viewport","TYPO3/CMS/Core/Event/RegularEvent","TYPO3/CMS/Backend/Storage/ModuleStateStorage","TYPO3/CMS/Backend/Icons"],(function(e,t,o,r,a,n,s,c,l){"use strict";var i,d;o=__importDefault(o),function(e){e.containerSelector="#typo3-cms-workspaces-backend-toolbaritems-workspaceselectortoolbaritem",e.activeMenuItemLinkSelector=".dropdown-menu .selected",e.menuItemIconHolderSelector=".dropdown-table-icon",e.menuItemSelector=".t3js-workspace-item",e.menuItemLinkSelector=".t3js-workspaces-switchlink",e.toolbarItemSelector=".dropdown-toggle",e.workspaceModuleLinkSelector=".t3js-workspaces-modulelink"}(i||(i={})),function(e){e.workspaceBodyClass="typo3-in-workspace",e.workspacesTitleInToolbarClass="toolbar-item-name"}(d||(d={}));class p{static refreshPageTree(){document.dispatchEvent(new CustomEvent("typo3:pagetree:refresh"))}static getWorkspaceState(){const e=document.querySelector([i.containerSelector,i.activeMenuItemLinkSelector,i.menuItemLinkSelector].join(" "));if(null===e)return null;const t=parseInt(e.dataset.workspaceid||"0",10);return{id:t,title:e.innerText.trim(),inWorkspace:0!==t}}static updateTopBar(e){(0,o.default)("."+d.workspacesTitleInToolbarClass,i.containerSelector).remove(),l.getIcon("empty-empty",l.sizes.small).then(e=>{(0,o.default)(i.containerSelector+" "+i.menuItemSelector).each((t,o)=>{const r=o.querySelector(i.menuItemIconHolderSelector);r&&(r.innerHTML=e)})}),e.inWorkspace&&e.title&&(0,o.default)(i.toolbarItemSelector,i.containerSelector).append((0,o.default)("<span>",{class:d.workspacesTitleInToolbarClass}).text(e.title));const t=document.querySelector([i.containerSelector,i.activeMenuItemLinkSelector,i.menuItemIconHolderSelector].join(" "));null!==t&&l.getIcon("actions-check",l.sizes.small).then(e=>{t.innerHTML=e})}static updateBackendContext(e=null){null===e&&null===(e=p.getWorkspaceState())||(e.inWorkspace?((0,o.default)("body").addClass(d.workspaceBodyClass),e.title||(e.title=TYPO3.lang["Workspaces.workspaceTitle"])):(0,o.default)("body").removeClass(d.workspaceBodyClass),p.updateTopBar(e))}constructor(){n.Topbar.Toolbar.registerEvent(()=>{this.initializeEvents(),p.updateBackendContext()}),new s("typo3:datahandler:process",e=>{const t=e.detail.payload;"sys_workspace"===t.table&&"delete"===t.action&&!1===t.hasErrors&&n.Topbar.refresh()}).bindTo(document)}performWorkspaceSwitch(e,t){var r,a;(0,o.default)(i.activeMenuItemLinkSelector,i.containerSelector).removeClass("selected"),null===(a=null===(r=(0,o.default)(i.menuItemLinkSelector+"[data-workspaceid="+e+"]",i.containerSelector))||void 0===r?void 0:r.closest(i.menuItemSelector))||void 0===a||a.addClass("selected"),p.updateBackendContext({id:e,title:t,inWorkspace:0!==e})}initializeEvents(){(0,o.default)(i.containerSelector).on("click",i.workspaceModuleLinkSelector,e=>{e.preventDefault(),a.App.showModule(e.currentTarget.dataset.module)}),(0,o.default)(i.containerSelector).on("click",i.menuItemLinkSelector,e=>{e.preventDefault(),this.switchWorkspace(parseInt(e.currentTarget.dataset.workspaceid,10))})}switchWorkspace(e){new r(TYPO3.settings.ajaxUrls.workspace_switch).post({workspaceId:e,pageId:c.ModuleStateStorage.current("web").identifier}).then(async t=>{const o=await t.resolve();o.workspaceId||(o.workspaceId=0),this.performWorkspaceSwitch(o.workspaceId,o.title||"");const r=a.App.getCurrentModule();if(o.pageId){let e=TYPO3.Backend.ContentContainer.getUrl();e+=(e.includes("?")?"&":"?")+"id="+o.pageId,n.ContentContainer.setUrl(e)}else r.startsWith("web_")?"web_WorkspacesWorkspaces"===r?a.App.showModule(r,"workspace="+e):a.App.reloadFrames():o.pageModule&&a.App.showModule(o.pageModule);p.refreshPageTree(),a.App.refreshMenu()})}}const u=new p;return TYPO3.WorkspacesMenu=u,u}));