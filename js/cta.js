!function(){function r(t,n,e){function o(i,c){if(!n[i]){if(!t[i]){var f="function"==typeof require&&require;if(!c&&f)return f(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var l=n[i]={exports:{}};t[i][0].call(l.exports,function(r){var n=t[i][1][r];return o(n?n:r)},l,l.exports,r,t,n,e)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<e.length;i++)o(e[i]);return o}return r}()({1:[function(r,t,n){"use strict";jQuery(document).ready(function(r){if(r(".block-cta svg")){var t=function(){for(var r=0;r<e.length;r++){var t=n(r),o=e.length-r-1;o*=750,setTimeout(t,o)}},n=function(r){var t=e[r];return function(){t.classList.toggle("on")}},e=document.querySelectorAll(".block-cta svg path");setInterval(function(){t()},1500)}})},{}]},{},[1]);